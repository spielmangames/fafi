<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer;

use FAFI\exception\FafiException;
use FAFI\exception\ImExErr;
use FAFI\src\BE\ImEx\Schema\Mapper\ImExableEntityMapperFactory;
use FAFI\src\BE\ImEx\Schema\Mapper\ImExableEntityMapperInterface;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;

class ImportMapper
{
    private int $line;


    private ImExableEntityMapperFactory $entityMapperFactory;

    public function __construct()
    {
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
     * @param string[] $convertedRow
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
            $mapped[$resourceMapper->fromFile($fieldName)] = $fieldValue;
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
