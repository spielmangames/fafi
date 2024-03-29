<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Import\Entity\Config;

use FAFI\exception\FafiException;
use FAFI\exception\ImExErr;
use FAFI\src\BE\Domain\Persistence\EntityDataHydratorFactory;
use FAFI\src\BE\Domain\Persistence\EntityDataHydratorInterface;
use FAFI\src\BE\ImEx\Clients\EntityClientFactory;
use FAFI\src\BE\ImEx\Clients\EntityClientInterface;
use FAFI\src\BE\ImEx\Schema\Mapper\ImExableEntityMapperFactory;
use FAFI\src\BE\ImEx\Schema\Mapper\ImExableEntityMapperInterface;
use FAFI\src\BE\ImEx\Transformer\Field\ImportFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\ImportFieldConverterFactory;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfigFactory;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\FieldSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\FieldSpecificationFactory;

class ImportableEntityConfigRetriever
{
    private ImportFieldConverterFactory $fieldConverterFactory;
    private FieldSpecificationFactory $fieldSpecificationFactory;
    private ImExableEntityMapperFactory $entityMapperFactory;
    private EntityDataHydratorFactory $entityDataHydratorFactory;
    private EntityClientFactory $entityClientFactory;

    private ImportableEntityConfigFactory $importableEntityConfigFactory;

    public function __construct()
    {
        $this->fieldConverterFactory = new ImportFieldConverterFactory();
        $this->fieldSpecificationFactory = new FieldSpecificationFactory();
        $this->entityMapperFactory = new ImExableEntityMapperFactory();
        $this->entityDataHydratorFactory = new EntityDataHydratorFactory();
        $this->entityClientFactory = new EntityClientFactory();

        $this->importableEntityConfigFactory = new ImportableEntityConfigFactory();
    }


    /**
     * @param ImportableEntityConfig $entityConfig
     * @param string $field
     *
     * @return ImportFieldConverter
     * @throws FafiException
     */
    public function getFieldConverter(ImportableEntityConfig $entityConfig, string $field): ImportFieldConverter
    {
        $class = $this->getFieldConverterClass($entityConfig, $field);
        return $this->fieldConverterFactory->create($class);
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
            throw new FafiException(sprintf(ImExErr::IMPORT_ENTITY_FIELD_CONVERTER_ABSENT, $field, $entity));
        }
        $class = $fieldConvertersMap[$field];
        if (!is_string($class)) {
            throw new FafiException(sprintf(ImExErr::IMPORT_ENTITY_FIELD_CONVERTER_INVALID, $field, $entity));
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
    public function getFieldSpecification(ImportableEntityConfig $entityConfig, string $field): FieldSpecification
    {
        $class = $this->getFieldSpecificationClass($entityConfig, $field);
        return $this->fieldSpecificationFactory->create($class);
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
            throw new FafiException(sprintf(ImExErr::IMPORT_ENTITY_FIELD_SPECIFICATION_ABSENT, $field, $entity));
        }
        $class = $fieldSpecificationsMap[$field];
        if (!is_string($class)) {
            throw new FafiException(sprintf(ImExErr::IMPORT_ENTITY_FIELD_SPECIFICATION_INVALID, $field, $entity));
        }

        return $class;
    }

    /**
     * @param ImportableEntityConfig $entityConfig
     *
     * @return ImExableEntityMapperInterface
     * @throws FafiException
     */
    public function getResourceMapper(ImportableEntityConfig $entityConfig): ImExableEntityMapperInterface
    {
        $class = $entityConfig->getResourceMapper();
        return $this->entityMapperFactory->create($class);
    }

    /**
     * @param ImportableEntityConfig $entityConfig
     *
     * @return EntityDataHydratorInterface
     * @throws FafiException
     */
    public function getResourceHydrator(ImportableEntityConfig $entityConfig): EntityDataHydratorInterface
    {
        $class = $entityConfig->getResourceDataHydrator();
        return $this->entityDataHydratorFactory->create($class);
    }

    /**
     * @param ImportableEntityConfig $entityConfig
     *
     * @return EntityClientInterface
     * @throws FafiException
     */
    public function getResourceLoader(ImportableEntityConfig $entityConfig): EntityClientInterface
    {
        $class = $entityConfig->getResourceLoader();
        return $this->entityClientFactory->create($class);
    }


    /**
     * @param ImportableEntityConfig $entityConfig
     * @param string $field
     *
     * @return ImportableEntityConfig
     * @throws FafiException
     */
    public function getSubResourceConfig(ImportableEntityConfig $entityConfig, string $field): ImportableEntityConfig
    {
        $subResources = $entityConfig->getSubResourcesMap();
        return $this->importableEntityConfigFactory->create($subResources[$field]);
    }
}
