<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Import\Load;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\ImEx\Clients\EntityClientFactory;
use FAFI\src\BE\ImEx\Clients\EntityClientInterface;
use FAFI\src\BE\ImEx\Import\ImportItem;
use FAFI\src\BE\ImEx\Transformer\AbstractImportModule;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;

class ImportLoader extends AbstractImportModule
{
    private EntityClientFactory $entityClientFactory;

    public function __construct()
    {
        parent::__construct();
        $this->entityClientFactory = new EntityClientFactory();
    }


    /**
     * @param ImportItem[] $transformedItems
     * @param ImportableEntityConfig $entityConfig
     *
     * @return void
     * @throws FafiException
     */
    public function load(array $transformedItems, ImportableEntityConfig $entityConfig): void
    {
        foreach ($transformedItems as $line => $transformedItem) {
            $this->line = $line;

            $id = $this->loadEntity($transformedItem->getTransformedContent(), $entityConfig);
            $this->loadSubEntities($transformedItem->setId($id));
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
        $loader = $this->prepareResourceLoader($entityConfig);
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
     * @param ImportableEntityConfig $entityConfig
     *
     * @return EntityClientInterface
     * @throws FafiException
     */
    private function prepareResourceLoader(ImportableEntityConfig $entityConfig): EntityClientInterface
    {
        $class = $entityConfig->getResourceLoader();

        try {
            $loader = $this->entityClientFactory->create($class);
        } catch (FafiException $exception) {
            $this->fail($exception->getMessage());
        }

        return $loader;
    }
}
