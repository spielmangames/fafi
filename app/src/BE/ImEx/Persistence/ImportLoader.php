<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence;

use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\Persistence\Client\EntityClientFactory;
use FAFI\src\BE\ImEx\Persistence\Client\EntityClientInterface;
use FAFI\src\BE\ImEx\Persistence\Hydrator\EntityHydratorFactory;
use FAFI\src\BE\ImEx\Persistence\Hydrator\EntityHydratorInterface;
use FAFI\src\BE\ImEx\Transformer\Schema\File\AbstractFileSchema;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;

class ImportLoader
{
    private EntityHydratorFactory $entityHydratorFactory;
    private EntityClientFactory $entityClientFactory;

    public function __construct()
    {
        $this->entityHydratorFactory = new EntityHydratorFactory();
        $this->entityClientFactory = new EntityClientFactory();
    }


    /**
     * @param array[] $entities
     * @param ImportableEntityConfig $entitySpecification
     *
     * @return void
     * @throws FafiException
     */
    public function load(array $entities, ImportableEntityConfig $entitySpecification): void
    {
        $resourceHydrator = $this->entityHydratorFactory->create($entitySpecification->getResourceHydrator());
        $subResourceHydrators = $this->buildSubResourceHydrators($entitySpecification);

        $resourceClient = $this->entityClientFactory->create($entitySpecification->getResourceLoader());
        $subResourceClients = $this->buildSubResourceClients($entitySpecification);

        foreach ($entities as $entityData) {
            $entity = $resourceHydrator->hydrate($entityData);

            $resource = $this->isFieldPresent($entityData, AbstractFileSchema::ID)
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
        foreach ($entitySpecification->getSubResourceHydrators() as $subResource => $hydrator) {
            $hydrators[$subResource] = $this->entityHydratorFactory->create($hydrator);
        }

        return $hydrators;
    }

    /**
     * @param ImportableEntityConfig $entitySpecification
     *
     * @return EntityClientInterface[]
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
