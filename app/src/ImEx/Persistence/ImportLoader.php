<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Persistence;

use FAFI\src\ImEx\Persistence\Client\EntityClientInterface;
use FAFI\src\ImEx\Persistence\Hydrator\EntityHydratorInterface;
use FAFI\src\ImEx\Transformer\Schema\File\AbstractFileSchema;

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
