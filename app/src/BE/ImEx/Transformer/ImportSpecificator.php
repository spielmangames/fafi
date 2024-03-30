<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer;

use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\Import\Entity\Config\ImportableEntityConfigRetriever;
use FAFI\src\BE\ImEx\Import\ImportItem;

class ImportSpecificator
{
    private ImportableEntityConfigRetriever $entityConfigRetriever;

    public function __construct()
    {
        $this->entityConfigRetriever = new ImportableEntityConfigRetriever();
    }


    /**
     * @param ImportItem $item
     *
     * @return void
     * @throws FafiException
     */
    public function validateEntity(ImportItem $item): void
    {
        $entityConfig = $item->getConfig();

        foreach ($item->getConvertedContent() as $fieldName => $fieldValue) {
            $fieldSpecification = $this->entityConfigRetriever->getFieldSpecification($entityConfig, $fieldName);
            $fieldSpecification->validate($fieldName, $fieldValue);
        }

        $this->validateSubEntities($item->getSubItems());
    }

    /**
     * @param ImportItem[] $subEntities
     *
     * @return void
     * @throws FafiException
     */
    private function validateSubEntities(array $subEntities): void
    {
        array_walk(
            $subEntities,
            fn(ImportItem $subEntity) => $this->validateEntity($subEntity)
        );
    }
}
