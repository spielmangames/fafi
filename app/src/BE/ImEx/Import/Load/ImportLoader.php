<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Import\Load;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\ImEx\Import\Entity\Config\ImportableEntityConfigRetriever;
use FAFI\src\BE\ImEx\Import\Fail\ImportFailurer;
use FAFI\src\BE\ImEx\Import\ImportItem;
use FAFI\src\BE\ImEx\Transformer\ImportHydrator;
use FAFI\src\BE\ImEx\Transformer\ImportMapper;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;

class ImportLoader
{
    private ImportableEntityConfigRetriever $entityConfigRetriever;
    private ImportMapper $importMapper;
    private ImportHydrator $importHydrator;
    private ImportFailurer $importFailurer;

    public function __construct()
    {
        $this->entityConfigRetriever = new ImportableEntityConfigRetriever();
        $this->importMapper = new ImportMapper();
        $this->importHydrator = new ImportHydrator();
        $this->importFailurer = new ImportFailurer();
    }


    /**
     * @param ImportItem[] $transformedItems
     *
     * @return void
     * @throws FafiException
     */
    public function load(array $transformedItems): void
    {
        try {
//            $transformedItems = $this->importMapper->execute($transformedItems);
//            $transformedItems = $this->importHydrator->execute($transformedItems);

            foreach ($transformedItems as $transformedItem) {
                $line = $transformedItem->getLine();

                $mappedItem = $this->importMapper->mapEntity($transformedItem);
                $hydratedItem = $this->importHydrator->hydrateEntity($mappedItem);

                $id = $this->loadEntity($transformedItem->getHydratedContent(), $transformedItem->getConfig());
                $this->loadSubEntities($transformedItem->setId($id));
            }
        } catch (FafiException $exception) {
            $this->importFailurer->fail($line, $exception->getMessage());
        }
    }


    /**
     * @param EntityDataInterface $transformedRow
     * @param ImportableEntityConfig $entityConfig
     *
     * @return int
     * @throws FafiException
     */
    private function loadEntity(EntityDataInterface $transformedRow, ImportableEntityConfig $entityConfig): int
    {
        $loader = $this->entityConfigRetriever->getResourceLoader($entityConfig);
        return $loader->save($transformedRow)->getId();
    }

    private function loadSubEntities(ImportItem $item): void
    {
        $id = $item->getId();

        foreach ($item->getSubItems() as $type => $subItem) {
            $content = $subItem->getHydratedContent();
            $content['product'] = $id;
            $this->loadEntity($content);
        }
    }
}
