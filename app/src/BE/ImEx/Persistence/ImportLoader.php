<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence;

use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\Persistence\Client\EntityClientFactory;
use FAFI\src\BE\ImEx\Persistence\Hydrator\EntityHydratorFactory;
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
        $resourceClient = $this->entityClientFactory->create($entitySpecification->getResourceLoader());

        foreach ($entities as $entity) {
            $hydrated = $resourceHydrator->hydrate($entity);
            $this->isIdPresent($entity) ? $resourceClient->update($hydrated) : $resourceClient->create($hydrated);
        }
    }

    private function isIdPresent(array $entity): bool
    {
        return array_key_exists(AbstractFileSchema::ID, $entity);
    }
}
