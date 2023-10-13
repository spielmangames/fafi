<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;

interface EntityDataHydratorInterface
{
    /**
     * @param array[] $data
     *
     * @return EntityDataInterface[]
     */
    public function hydrateCollection(array $data): array;

    public function hydrate(array $data): EntityDataInterface;

    public function dehydrate(EntityDataInterface $entity): array;
}
