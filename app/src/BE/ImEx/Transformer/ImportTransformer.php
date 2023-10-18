<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer;

use FAFI\exception\FafiException;
use FAFI\exception\ImExErr;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\ImEx\Transformer\Field\ImportFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\ImportFieldConverterFactory;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\FieldSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\FieldSpecificationFactory;

class ImportTransformer
{
    private int $line;


    private ImportFieldConverterFactory $fieldConverterFactory;
    private FieldSpecificationFactory $fieldSpecificationFactory;

    public function __construct()
    {
        $this->fieldConverterFactory = new ImportFieldConverterFactory();
        $this->fieldSpecificationFactory = new FieldSpecificationFactory();
    }


    /**
     * @param string[][] $extractedRows
     * @param ImportableEntityConfig $entityConfig
     *
     * @return EntityDataInterface[]
     * @throws FafiException
     */
    public function transform(array $extractedRows, ImportableEntityConfig $entityConfig): array
    {
        $transformed = [];

        foreach ($extractedRows as $line => $extractedRow) {
            $this->line = $line;
            $transformed[$line] = $this->transformEntity($extractedRow, $entityConfig);
        }

        return $transformed;
    }


    /**
     * @param string[] $extractedRow
     * @param ImportableEntityConfig $entityConfig
     *
     * @return EntityDataInterface
     * @throws FafiException
     */
    private function transformEntity(array $extractedRow, ImportableEntityConfig $entityConfig): EntityDataInterface
    {
        $transformed = [];

        foreach ($extractedRow as $fieldName => $fieldValue) {
            $fieldConverter = $this->prepareFieldConverter($entityConfig, $fieldName);
            $fieldValue = $fieldConverter->fromStr($fieldName, $fieldValue);

            $fieldSpecification = $this->prepareFieldSpecification($entityConfig, $fieldName);
            $fieldSpecification->validate($fieldName, $fieldValue);

            $transformed[$fieldName] = $fieldValue;
        }

        return $transformed;
    }

    /**
     * @param ImportableEntityConfig $entityConfig
     * @param string $field
     *
     * @return ImportFieldConverter
     * @throws FafiException
     */
    private function prepareFieldConverter(ImportableEntityConfig $entityConfig, string $field): ImportFieldConverter
    {
        $class = $this->getFieldConverterClass($entityConfig, $field);

        try {
            $converter = $this->fieldConverterFactory->create($class);
        } catch (FafiException $exception) {
            $this->fail($exception->getMessage());
        }

        return $converter;
    }

    /**
     * @param ImportableEntityConfig $entityConfig
     * @param string $field
     *
     * @return string
     * @throws FafiException
     */
    private function getFieldConverterClass(ImportableEntityConfig $entityConfig, string $field): string
    {
        $entity = $entityConfig->getEntityName();
        $fieldConvertersMap = $entityConfig->getFieldConvertersMap();

        if (!isset($fieldConvertersMap[$field])) {
            $this->fail(sprintf(ImExErr::IMPORT_ENTITY_FIELD_CONVERTER_ABSENT, $field, $entity));
        }
        $class = $fieldConvertersMap[$field];
        if (!is_string($class)) {
            $this->fail(sprintf(ImExErr::IMPORT_ENTITY_FIELD_CONVERTER_INVALID, $field, $entity));
        }

        return $class;
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


    /**
     * @param string $error
     *
     * @return void
     * @throws FafiException
     */
    private function fail(string $error): void
    {
        $e = [sprintf(ImExErr::IMPORT_FAILED, $this->line), $error];
        throw new FafiException(FafiException::combine($e));
    }
}
