<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Import\Load;

use FAFI\exception\FafiException;
use FAFI\exception\ImExErr;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\ImEx\Clients\EntityClientFactory;
use FAFI\src\BE\ImEx\Clients\EntityClientInterface;
use FAFI\src\BE\ImEx\Import\Entity\Config\ImportableEntityConfigRetriever;
use FAFI\src\BE\ImEx\Import\ImportItem;
use FAFI\src\BE\ImEx\Transformer\ImportHydrator;
use FAFI\src\BE\ImEx\Transformer\ImportMapper;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;

class ImportLoader
{
    private ImportMapper $importMapper;
    private ImportHydrator $importHydrator;
    private ImportableEntityConfigRetriever $entityConfigRetriever;

    public function __construct()
    {
        $this->importMapper = new ImportMapper();
        $this->importHydrator = new ImportHydrator();
        $this->entityConfigRetriever = new ImportableEntityConfigRetriever();
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
            $transformedItems = $this->importMapper->execute($transformedItems);
            $transformedItems = $this->importHydrator->execute($transformedItems);

            foreach ($transformedItems as $line => $transformedItem) {
                $this->line = $line;

                $id = $this->loadEntity($transformedItem->getTransformedContent(), $transformedItem->getConfig());
                $this->loadSubEntities($transformedItem->setId($id));
            }
        } catch (FafiException $exception) {
            $this->fail($line, $exception->getMessage());
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
            $content = $subItem->getTransformedContent();
            $content['product'] = $id;
            $this->loadEntity($content);
        }
    }


    /**
     * @param int $line
     * @param string $error
     *
     * @return void
     * @throws FafiException
     */
    private function fail(int $line, string $error): void
    {
        $e = [sprintf(ImExErr::IMPORT_FAILED, $line), $error];
        throw new FafiException(FafiException::combine($e));
    }
}
