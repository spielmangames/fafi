<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer;

use FAFI\exception\FafiException;
use FAFI\exception\ImExErr;
use FAFI\src\BE\ImEx\Transformer\Field\ImportFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\ImportFieldConverterFactory;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;

class ImportConverter
{
    private int $line;


    private ImportFieldConverterFactory $fieldConverterFactory;

    public function __construct()
    {
        $this->fieldConverterFactory = new ImportFieldConverterFactory();
    }


    /**
     * @param string[][] $extractedRows
     * @param ImportableEntityConfig $entityConfig
     *
     * @return array[]
     * @throws FafiException
     */
    public function convert(array $extractedRows, ImportableEntityConfig $entityConfig): array
    {
        $converted = [];

        foreach ($extractedRows as $line => $extractedRow) {
            $this->line = $line;
            $converted[$line] = $this->convertEntity($extractedRow, $entityConfig);
        }

        return $converted;
    }


    /**
     * @param string[] $extractedRow
     * @param ImportableEntityConfig $entityConfig
     *
     * @return array
     * @throws FafiException
     */
    private function convertEntity(array $extractedRow, ImportableEntityConfig $entityConfig): array
    {
        $converted = [];

        foreach ($extractedRow as $fieldName => $fieldValue) {
            $fieldConverter = $this->prepareFieldConverter($entityConfig, $fieldName);
            $fieldValue = $fieldConverter->fromStr($fieldName, $fieldValue);

            $converted[$fieldName] = $fieldValue;
        }

        return $converted;
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
