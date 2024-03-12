<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer;

use FAFI\exception\FafiException;
use FAFI\exception\ImExErr;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\FieldSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\FieldSpecificationFactory;

class ImportSpecificator extends AbstractImportModule
{
    private FieldSpecificationFactory $fieldSpecificationFactory;

    public function __construct()
    {
        parent::__construct();
        $this->fieldSpecificationFactory = new FieldSpecificationFactory();
    }


    /**
     * @param array[] $convertedRows
     * @param ImportableEntityConfig $entityConfig
     *
     * @return void
     * @throws FafiException
     */
    public function validate(array $convertedRows, ImportableEntityConfig $entityConfig): void
    {
        foreach ($convertedRows as $line => $convertedRow) {
            $this->line = $line;
            $this->validateEntity($convertedRow, $entityConfig);
        }
    }


    /**
     * @param array $convertedRow
     * @param ImportableEntityConfig $entityConfig
     *
     * @return void
     * @throws FafiException
     */
    private function validateEntity(array $convertedRow, ImportableEntityConfig $entityConfig): void
    {
        try {
            foreach ($convertedRow as $fieldName => $fieldValue) {
                if ($this->isSubResource($fieldName, $entityConfig)) {
                    $subResourceConfig = $this->prepareSubResourceConfig($fieldName, $entityConfig);
                    $this->validateSubEntities($fieldValue, $subResourceConfig);
                } else {
                    $fieldSpecification = $this->prepareFieldSpecification($entityConfig, $fieldName);
                    $fieldSpecification->validate($fieldName, $fieldValue);
                }
            }
        } catch (FafiException $exception) {
            $this->fail($exception->getMessage());
        }
    }

    /**
     * @param array[] $subEntities
     * @param ImportableEntityConfig $subEntityConfig
     *
     * @return void
     * @throws FafiException
     */
    private function validateSubEntities(array $subEntities, ImportableEntityConfig $subEntityConfig): void
    {
        foreach ($subEntities as $subEntity) {
            $this->validateEntity($subEntity, $subEntityConfig);
        }
    }


    /**
     * @param ImportableEntityConfig $entityConfig
     * @param string $field
     *
     * @return FieldSpecification
     * @throws FafiException
     */
    private function prepareFieldSpecification(ImportableEntityConfig $entityConfig, string $field): FieldSpecification
    {
        $class = $this->getFieldSpecificationClass($entityConfig, $field);

        try {
            $specification = $this->fieldSpecificationFactory->create($class);
        } catch (FafiException $exception) {
            $this->fail($exception->getMessage());
        }

        return $specification;
    }

    /**
     * @param ImportableEntityConfig $entityConfig
     * @param string $field
     *
     * @return string
     * @throws FafiException
     */
    private function getFieldSpecificationClass(ImportableEntityConfig $entityConfig, string $field): string
    {
        $entity = $entityConfig->getEntityName();
        $fieldSpecificationsMap = $entityConfig->getFieldSpecificationsMap();

        if (!isset($fieldSpecificationsMap[$field])) {
            $this->fail(sprintf(ImExErr::IMPORT_ENTITY_FIELD_SPECIFICATION_ABSENT, $field, $entity));
        }
        $class = $fieldSpecificationsMap[$field];
        if (!is_string($class)) {
            $this->fail(sprintf(ImExErr::IMPORT_ENTITY_FIELD_SPECIFICATION_INVALID, $field, $entity));
        }

        return $class;
    }
}
