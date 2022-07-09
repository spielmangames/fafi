<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\EntityInterface;
use FAFI\src\BE\ImEx\Persistence\Client\EntityClientFactory;
use FAFI\src\BE\ImEx\Persistence\Client\EntityClientInterface;
use FAFI\src\BE\ImEx\Persistence\Hydrator\EntityHydratorFactory;
use FAFI\src\BE\ImEx\Persistence\Hydrator\EntityHydratorInterface;
use FAFI\src\BE\ImEx\Transformer\Schema\File\AbstractFileSchema;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImExEntitySpecification;

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
     * @param ImExEntitySpecification $entitySpecification
     *
     * @return void
     * @throws FafiException
     */
    public function load(array $entities, ImExEntitySpecification $entitySpecification): void
    {
        $resourceHydrator = $this->entityHydratorFactory->create($entitySpecification->getResourceHydrator());
        $subResourceHydrators = $this->buildSubResourceHydrators($entitySpecification);

        $resourceClient = $this->entityClientFactory->create($entitySpecification->getResourceLoader());
        $subResourceClients = $this->buildSubResourceClients($entitySpecification);

        foreach ($entities as $entity) {

            $hydrated = $resourceHydrator->hydrate($entity);
            $this->isIdPresent($entity) ? $resourceClient->update($hydrated) : $resourceClient->create($hydrated);
        }
    }


    /**
     * @param ImExEntitySpecification $entitySpecification
     *
     * @return EntityHydratorInterface[]
     * @throws FafiException
     */
    private function buildSubResourceHydrators(ImExEntitySpecification $entitySpecification): array
    {
        $hydrators = [];
        foreach ($entitySpecification->getSubResourceHydrators() as $subResource => $hydrator) {
            $hydrators[$subResource] = $this->entityHydratorFactory->create($hydrator);
        }

        return $hydrators;
    }

    /**
     * @param ImExEntitySpecification $entitySpecification
     *
     * @return EntityClientInterface[]
     * @throws FafiException
     */
    private function buildSubResourceClients(ImExEntitySpecification $entitySpecification): array
    {
        $clients = [];
        foreach ($entitySpecification->getSubResourceLoaders() as $subResource => $client) {
            $clients[$subResource] = $this->entityClientFactory->create($client);
        }

        return $clients;
    }

    private function isSubResourcePresent(array $entity, string $subResource): bool
    {
        return array_key_exists($subResource, $entity);
    }

    private function isIdPresent(array $entity): bool
    {
        return array_key_exists(AbstractFileSchema::ID, $entity);
    }
}
