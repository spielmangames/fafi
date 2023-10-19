<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Import\Load;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Persistence\EntityDataHydratorFactory;
use FAFI\src\BE\ImEx\Clients\EntityClientFactory;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;

class ImportLoader
{
    private EntityDataHydratorFactory $entityDataHydratorFactory;
    private EntityClientFactory $entityClientFactory;

    public function __construct()
    {
        $this->entityDataHydratorFactory = new EntityDataHydratorFactory();
        $this->entityClientFactory = new EntityClientFactory();
    }


    /**
     * @param EntityDataInterface[] $entities
     * @param ImportableEntityConfig $entitySpecification
     *
     * @return void
     * @throws FafiException
     */
    public function load(array $entities, ImportableEntityConfig $entitySpecification): void
    {
        $resourceHydrator = $this->entityDataHydratorFactory->create($entitySpecification->getResourceDataHydrator());
        $subResourceHydrators = $this->buildSubResourceHydrators($entitySpecification);

        $resourceClient = $this->entityClientFactory->create($entitySpecification->getResourceLoader());
        $subResourceClients = $this->buildSubResourceClients($entitySpecification);

        foreach ($entities as $entityData) {
            $entity = $resourceHydrator->hydrate($entityData);

            $resource = $this->isFieldPresent($entityData, AbstractEntityFileSchema::ID)
                ? $resourceClient->update($entity)
                : $resourceClient->create($entity);

            foreach ($subResourceHydrators as $field => $subResourceHydrator) {
                if ($this->isFieldPresent($entityData, $field)) {
                    $subEntity = $subResourceHydrator->hydrate($entityData[$field]);

                    $subResourceClients[$field]->create($subEntity);
                }
            }
        }
    }


    /**
     * @param ImportableEntityConfig $entitySpecification
     *
     * @return EntityHydratorInterface[]
     * @throws FafiException
     */
    private function buildSubResourceHydrators(ImportableEntityConfig $entitySpecification): array
    {
        $hydrators = [];
        foreach ($entitySpecification->getSubResourceDataHydrators() as $subResource => $hydrator) {
            $hydrators[$subResource] = $this->entityDataHydratorFactory->create($hydrator);
        }

        return $hydrators;
    }

    /**
     * @param ImportableEntityConfig $entitySpecification
     *
     * @return \FAFI\src\BE\ImEx\Clients\EntityClientInterface[]
     * @throws FafiException
     */
    private function buildSubResourceClients(ImportableEntityConfig $entitySpecification): array
    {
        $clients = [];
        foreach ($entitySpecification->getSubResourceLoaders() as $subResource => $client) {
            $clients[$subResource] = $this->entityClientFactory->create($client);
        }

        return $clients;
    }

    private function isFieldPresent(array $entity, string $field): bool
    {
        return array_key_exists($field, $entity);
    }
}
