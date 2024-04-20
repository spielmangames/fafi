<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer;

use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\Import\Entity\Config\ImportableEntityConfigRetriever;
use FAFI\src\BE\ImEx\Import\ImportItem;

class ImportMapper
{
    private ImportableEntityConfigRetriever $entityConfigRetriever;

    public function __construct()
    {
        $this->entityConfigRetriever = new ImportableEntityConfigRetriever();
    }


    /**
     * @param ImportItem[] $convertedItems
     *
     * @return ImportItem[]
     * @throws FafiException
     */
    public function execute(array $convertedItems): array
    {
        $mapped = [];

        foreach ($convertedItems as $convertedItem) {
            $mapped[] = $this->mapEntity($convertedItem, true);
        }

        return $mapped;
    }


    /**
     * @param ImportItem $item
     * @param bool $mapSubItems
     *
     * @return ImportItem
     * @throws FafiException
     */
    public function mapEntity(ImportItem $item, bool $mapSubItems = false): ImportItem
    {
        $entityConfig = $item->getConfig();

        $resourceMapper = $this->entityConfigRetriever->getResourceMapper($entityConfig);

        $mapped = [];
        foreach ($item->getConvertedContent() as $fieldName => $fieldValue) {
            $fieldName = $resourceMapper->fromFile($fieldName);
            $mapped[$fieldName] = $fieldValue;
        }
        $item->cleanupConvertedContent()->setMappedContent($mapped);

        if ($mapSubItems) {
            $subEntities = $this->mapSubEntities($item);
            $item->setSubItems($subEntities);
        }

        return $item;
    }

    /**
     * @param ImportItem $item
     *
     * @return array
     * @throws FafiException
     */
    public function mapSubEntities(ImportItem $item): array
    {
        $mapped = [];

        foreach ($item->getSubItems() as $subEntity) {
            $mapped[] = $this->mapEntity($subEntity);
        }

        return $mapped;
    }
}
