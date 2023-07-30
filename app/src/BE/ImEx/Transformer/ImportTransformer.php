<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer;

use FAFI\exception\FafiException;
use FAFI\exception\ImExErr;
use FAFI\src\BE\ImEx\Transformer\Field\ImportFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\ImExFieldConverterFactory;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\FieldSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\FieldSpecificationFactory;

class ImportTransformer
{
    private int $line;

    private ImportEntityValidator $entityValidator;
    private ImExFieldConverterFactory $fieldTransformerFactory;
    private FieldSpecificationFactory $fieldSpecificationFactory;

    public function __construct()
    {
        $this->entityValidator = new ImportEntityValidator();
        $this->fieldTransformerFactory = new ImExFieldConverterFactory();
        $this->fieldSpecificationFactory = new FieldSpecificationFactory();
    }


    /**
     * @param string[][] $entities
     * @param ImportableEntityConfig $entityConfig
     *
     * @return array
     * @throws FafiException
     */
    public function transform(array $entities, ImportableEntityConfig $entityConfig): array
    {
        $transformed = [];

        foreach ($entities as $line => $entity) {
            $this->line = $line;

            $this->entityValidator->validateEntity($line, $entity, $entityConfig);
            $transformed[$line] = $this->transformEntity($entity, $entityConfig);
        }

        return $transformed;
    }


    /**
     * @param array $entity
     * @param ImportableEntityConfig $entityConfig
     *
     * @return array
     * @throws FafiException
     */
    private function transformEntity(array $entity, ImportableEntityConfig $entityConfig): array
    {
        $transformed = [];

        foreach ($entity as $fieldName => $fieldValue) {
            if ($fieldValue === '') {
                $fieldValue = null;
            } else {
                $fieldTransformer = $this->prepareFieldTransformer($entityConfig, $fieldName);
                $fieldValue = $fieldTransformer->fromStr($fieldName, $fieldValue);

                $fieldSpecification = $this->prepareFieldSpecification($entityConfig, $fieldName);
                $fieldSpecification->validate($fieldName, $fieldValue);
            }

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
    private function prepareFieldTransformer(ImportableEntityConfig $entityConfig, string $field): ImportFieldConverter
    {
        $entity = $entityConfig->getEntityName();
        $fieldTransformersMap = $entityConfig->getFieldConvertersMap();

        if (!isset($fieldTransformersMap[$field])) {
           $this->fail(sprintf(ImExErr::IMPORT_ENTITY_FIELD_TRANSFORMER_ABSENT, $field, $entity));
        }
        $class = $fieldTransformersMap[$field];
        if (!is_string($class)) {
            $this->fail(sprintf(ImExErr::IMPORT_ENTITY_FIELD_TRANSFORMER_INVALID, $field, $entity));
        }

        try {
            $transformer = $this->fieldTransformerFactory->create($class);
        } catch (FafiException $exception) {
            $this->fail($exception->getMessage());
        }

        return $transformer;
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
        $entity = $entityConfig->getEntityName();
        $fieldSpecificationsMap = $entityConfig->getFieldSpecificationsMap();

        if (!isset($fieldSpecificationsMap[$field])) {
            $this->fail(sprintf(ImExErr::IMPORT_ENTITY_FIELD_SPECIFICATION_ABSENT, $field, $entity));
        }
        $fieldSpecification = $fieldSpecificationsMap[$field];
        if (!is_array($fieldSpecification) || empty($fieldSpecification) || count($fieldSpecification) > 2) {
            $this->fail(sprintf(ImExErr::IMPORT_ENTITY_FIELD_SPECIFICATION_INVALID, $field, $entity));
        }

        if (!isset($fieldSpecification[ImportableEntityConfig::OBJECT])) {
            $this->fail(sprintf(ImExErr::IMPORT_ENTITY_FIELD_SPECIFICATION_INVALID, $field, $entity));
        }
        $class = $fieldSpecification[ImportableEntityConfig::OBJECT];
        if (!is_string($class)) {
            $this->fail(sprintf(ImExErr::IMPORT_ENTITY_FIELD_SPECIFICATION_INVALID, $field, $entity));
        }

        $params = null;
        if (isset($fieldSpecification[ImportableEntityConfig::PARAMS])) {
            $params = $fieldSpecification[ImportableEntityConfig::PARAMS];

            if (!is_array($params) || empty($params)) {
                $this->fail(sprintf(ImExErr::IMPORT_ENTITY_FIELD_SPECIFICATION_INVALID, $field, $entity));
            }
        }

        try {
            $specification = $this->fieldSpecificationFactory->create($class, $params);
        } catch (FafiException $exception) {
            $this->fail($exception->getMessage());
        }

        return $specification;
    }


    /**
     * @param string $error
     *
     * @return void
     * @throws FafiException
     */
    private function fail(string $error): void
    {
        throw new FafiException(FafiException::combine([sprintf(ImExErr::IMPORT_FAILED, $this->line), $error]));
    }
}
