<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence;

use FAFI\src\BE\ImEx\Persistence\Client\EntityClientInterface;
use FAFI\src\BE\ImEx\Persistence\Hydrator\EntityHydratorInterface;
use FAFI\src\BE\ImEx\Transformer\Schema\File\AbstractFileSchema;

class ImportLoader
{
    /**
     * @param array[] $entities
     * @param EntityHydratorInterface $hydrator
     * @param EntityClientInterface $client
     *
     * @return void
     */
    public function load(array $entities, EntityHydratorInterface $hydrator, EntityClientInterface $client): void
    {
        foreach ($entities as $entity) {
            $hydrated = $hydrator->hydrate($entity);
            $this->isIdPresent($entity) ? $client->update($hydrated) : $client->create($hydrated);
        }
    }

    private function isIdPresent(array $entity): bool
    {
        return array_key_exists(AbstractFileSchema::ID, $entity);
    }
}