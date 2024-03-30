<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer;

use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\Import\Entity\Config\ImportableEntityConfigRetriever;
use FAFI\src\BE\ImEx\Import\ImportItem;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;

class ImportConverter
{
    private ImportableEntityConfigRetriever $entityConfigRetriever;

    public function __construct()
    {
        $this->entityConfigRetriever = new ImportableEntityConfigRetriever();
    }


    /**
     * @param int $line
     * @param string[] $extractedRow
     * @param ImportableEntityConfig $entityConfig
     *
     * @return ImportItem
     * @throws FafiException
     */
    public function convertEntity(int $line, array $extractedRow, ImportableEntityConfig $entityConfig): ImportItem
    {
        $item = new ImportItem($line, $entityConfig);

        $converted = [];
        foreach ($extractedRow as $fieldName => $fieldValue) {
            $fieldConverter = $this->entityConfigRetriever->getFieldConverter($entityConfig, $fieldName);
            $fieldValue = $fieldConverter->fromStr($fieldName, $fieldValue);

            if (!$this->isSubResource($entityConfig, $fieldName)) {
                $converted[$fieldName] = $fieldValue;
                continue;
            }

            $subResourceConfig = $this->entityConfigRetriever->getSubResourceConfig($entityConfig, $fieldName);
            $subEntities = $this->convertSubEntities($line, $fieldValue, $subResourceConfig);
            $item->addSubItems($subEntities);
        }
        $item->setConvertedContent($converted);

        return $item;
    }

    /**
     * @param int $line
     * @param string[][] $subEntities
     * @param ImportableEntityConfig $entityConfig
     *
     * @return ImportItem[]
     * @throws FafiException
     */
    private function convertSubEntities(int $line, array $subEntities, ImportableEntityConfig $entityConfig): array
    {
        return array_map(
            fn(array $subEntity): ImportItem => $this->convertEntity($line, $subEntity, $entityConfig),
            $subEntities
        );
    }


    private function isSubResource(ImportableEntityConfig $entityConfig, string $fieldName): bool
    {
        return array_key_exists($fieldName, $entityConfig->getSubResourcesMap());
    }
}
