<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer;

use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\Schema\Mapper\ImExableEntityMapperFactory;
use FAFI\src\BE\ImEx\Schema\Mapper\ImExableEntityMapperInterface;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;

class ImportMapper extends AbstractImportModule
{
    private ImExableEntityMapperFactory $entityMapperFactory;

    public function __construct()
    {
        parent::__construct();
        $this->entityMapperFactory = new ImExableEntityMapperFactory();
    }


    /**
     * @param array[] $convertedRows
     * @param ImportableEntityConfig $entityConfig
     *
     * @return array[]
     * @throws FafiException
     */
    public function map(array $convertedRows, ImportableEntityConfig $entityConfig): array
    {
        $mapped = [];

        foreach ($convertedRows as $line => $convertedRow) {
            $this->line = $line;
            $mapped[$line] = $this->mapEntity($convertedRow, $entityConfig);
        }

        return $mapped;
    }


    /**
     * @param string[]|array[] $convertedRow
     * @param ImportableEntityConfig $entityConfig
     *
     * @return array
     * @throws FafiException
     */
    private function mapEntity(array $convertedRow, ImportableEntityConfig $entityConfig): array
    {
        $mapped = [];

        $resourceMapper = $this->prepareResourceMapper($entityConfig);
        foreach ($convertedRow as $fieldName => $fieldValue) {
            if ($this->isSubResource($fieldName, $entityConfig)) {
                $subResourceConfig = $this->prepareSubResourceConfig($fieldName, $entityConfig);
                $fieldValue = $this->mapSubEntities($fieldValue, $subResourceConfig);
            } else {
                $fieldName = $resourceMapper->fromFile($fieldName);
            }

            $mapped[$fieldName] = $fieldValue;

        }

        return $mapped;
    }

    /**
     * @param array[] $subEntities
     * @param ImportableEntityConfig $subEntityConfig
     *
     * @return array
     * @throws FafiException
     */
    private function mapSubEntities(array $subEntities, ImportableEntityConfig $subEntityConfig): array
    {
        $mapped = [];

        foreach ($subEntities as $subEntity) {
            $mapped[] = $this->mapEntity($subEntity, $subEntityConfig);
        }

        return $mapped;
    }


    /**
     * @param ImportableEntityConfig $entityConfig
     *
     * @return ImExableEntityMapperInterface
     * @throws FafiException
     */
    private function prepareResourceMapper(ImportableEntityConfig $entityConfig): ImExableEntityMapperInterface
    {
        $class = $entityConfig->getResourceMapper();

        try {
            $mapper = $this->entityMapperFactory->create($class);
        } catch (FafiException $exception) {
            $this->fail($exception->getMessage());
        }

        return $mapper;
    }
}
