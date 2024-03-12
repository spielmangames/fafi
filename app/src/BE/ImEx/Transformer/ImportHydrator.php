<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Persistence\EntityDataHydratorFactory;
use FAFI\src\BE\Domain\Persistence\EntityDataHydratorInterface;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;

class ImportHydrator extends AbstractImportModule
{
    private EntityDataHydratorFactory $entityDataHydratorFactory;

    public function __construct()
    {
        parent::__construct();
        $this->entityDataHydratorFactory = new EntityDataHydratorFactory();

    }


    /**
     * @param array[] $mappedRows
     * @param ImportableEntityConfig $entityConfig
     *
     * @return EntityDataInterface[]
     * @throws FafiException
     */
    public function hydrate(array $mappedRows, ImportableEntityConfig $entityConfig): array
    {
        $hydrated = [];

        foreach ($mappedRows as $line => $mappedRow) {
            $this->line = $line;
            $hydrated[$line] = $this->hydrateEntity($mappedRow, $entityConfig);
        }

        return $hydrated;
    }


    /**
     * @param array $mappedRow
     * @param ImportableEntityConfig $entityConfig
     *
     * @return EntityDataInterface
     * @throws FafiException
     */
    private function hydrateEntity(array $mappedRow, ImportableEntityConfig $entityConfig): EntityDataInterface
    {
        [$entity, $subEntities] = $this->splitSubResources($mappedRow, $entityConfig);
        $resourceHydrator = $this->prepareResourceHydrator($entityConfig);

        return $resourceHydrator->hydrate($mappedRow);
    }

    private function hydrateSubEntities(): array
    {

    }


    /**
     * @param ImportableEntityConfig $entityConfig
     *
     * @return EntityDataHydratorInterface
     * @throws FafiException
     */
    private function prepareResourceHydrator(ImportableEntityConfig $entityConfig): EntityDataHydratorInterface
    {
        $class = $entityConfig->getResourceDataHydrator();

        try {
            $hydrator = $this->entityDataHydratorFactory->create($class);
        } catch (FafiException $exception) {
            $this->fail($exception->getMessage());
        }

        return $hydrator;
    }
}
