<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer;

use FAFI\exception\FafiException;
use FAFI\exception\ImExErr;
use FAFI\src\BE\ImEx\Transformer\Field\ImExFieldTransformer;
use FAFI\src\BE\ImEx\Transformer\Field\ImExFieldTransformerFactory;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\FieldSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\ImExFieldSpecificationFactory;

class ImportTransformer
{
    private ImportEntityValidator $entityValidator;
    private ImExFieldTransformerFactory $fieldTransformerFactory;
    private ImExFieldSpecificationFactory $fieldSpecificationFactory;

    public function __construct()
    {
        $this->entityValidator = new ImportEntityValidator();
        $this->fieldTransformerFactory = new ImExFieldTransformerFactory();
        $this->fieldSpecificationFactory = new ImExFieldSpecificationFactory();
    }


    /**
     * @param array $entities
     * @param ImportableEntityConfig $entityConfig
     *
     * @return array
     * @throws FafiException
     */
    public function transform(array $entities, ImportableEntityConfig $entityConfig): array
    {
        $transformed = [];

        foreach ($entities as $line => $entity) {
            $this->entityValidator->validateEntity($line, $entity, $entityConfig);
            $transformed[$line] = $this->transformEntity($line, $entity, $entityConfig);
        }

        return $transformed;
    }


    /**
     * @param int $line
     * @param array $entity
     * @param ImportableEntityConfig $entityConfig
     *
     * @return array
     * @throws FafiException
     */
    private function transformEntity(int $line, array $entity, ImportableEntityConfig $entityConfig): array
    {
        $transformed = [];

        foreach ($entity as $fieldName => $fieldValue) {
            if ($fieldValue === '') {
                $fieldValue = null;
            } else {
                $fieldTransformer = $this->prepareFieldTransformer($line, $entityConfig, $fieldName);
                $fieldValue = $fieldTransformer->fromStr($fieldName, $fieldValue);

                $fieldSpecification = $this->prepareFieldSpecification($line, $entityConfig, $fieldName);
                $fieldSpecification->validate($fieldName, $fieldValue);
            }

            $transformed[$fieldName] = $fieldValue;
        }

        return $transformed;
    }

    /**
     * @param int $line
     * @param ImportableEntityConfig $entityConfig
     * @param string $field
     *
     * @return ImExFieldTransformer
     * @throws FafiException
     */
    private function prepareFieldTransformer(int $line, ImportableEntityConfig $entityConfig, string $field): ImExFieldTransformer
    {
        $entity = $entityConfig->getEntityName();

        $fieldTransformersMap = $entityConfig->getFieldTransformersMap();
        if (!isset($fieldTransformersMap[$field])) {
            $e = [
                sprintf(ImExErr::IMPORT_FAILED, $line),
                sprintf(ImExErr::IMPORT_ENTITY_FIELD_TRANSFORMER_ABSENT, $field, $entity),
            ];
            throw new FafiException(FafiException::combine($e));
        }

        return $this->fieldTransformerFactory->create($fieldTransformersMap[$field]);
    }

    /**
     * @param int $line
     * @param ImportableEntityConfig $entityConfig
     * @param string $field
     *
     * @return FieldSpecification
     * @throws FafiException
     */
    private function prepareFieldSpecification(int $line, ImportableEntityConfig $entityConfig, string $field): FieldSpecification
    {
        $entity = $entityConfig->getEntityName();

        $fieldSpecificationsMap = $entityConfig->getFieldSpecificationsMap();
        if (!isset($fieldSpecificationsMap[$field])) {
            $e = sprintf(ImExErr::IMPORT_ENTITY_FIELD_SPECIFICATION_ABSENT, $field, $entity);
            $this->fail($line, $e);
        }

        $fieldSpecification = $fieldSpecificationsMap[$field];
        if (!is_array($fieldSpecification) || empty($fieldSpecification) || count($fieldSpecification) > 2) {
            $e = sprintf(ImExErr::IMPORT_ENTITY_FIELD_SPECIFICATION_INVALID, $field, $entity);
            $this->fail($line, $e);
        }

        if (!isset($fieldSpecification[ImportableEntityConfig::OBJECT])) {
            $e = sprintf(ImExErr::IMPORT_ENTITY_FIELD_SPECIFICATION_INVALID, $field, $entity);
            $this->fail($line, $e);
        }
        $class = $fieldSpecification[ImportableEntityConfig::OBJECT];
        if (!is_string($class)) {
            $e = sprintf(ImExErr::IMPORT_ENTITY_FIELD_SPECIFICATION_INVALID, $field, $entity);
            $this->fail($line, $e);
        }

        $params = null;
        if (isset($fieldSpecification[ImportableEntityConfig::PARAMS])) {
            $params = $fieldSpecification[ImportableEntityConfig::PARAMS];

            if (!is_array($params) || empty($params)) {
                $e = sprintf(ImExErr::IMPORT_ENTITY_FIELD_SPECIFICATION_INVALID, $field, $entity);
                $this->fail($line, $e);
            }
        }

        try {
            $specification = $this->fieldSpecificationFactory->create($class, $params);
        } catch (FafiException $exception) {
            $this->fail($line, $exception->getMessage());
        }

        return $specification;
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
        throw new FafiException(FafiException::combine([sprintf(ImExErr::IMPORT_FAILED, $line), $error]));
    }
}
