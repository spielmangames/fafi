<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\EntityInterface;

interface EntityHydratorInterface
{
    /**
     * @param array[] $data
     *
     * @return EntityInterface[]
     */
    public function hydrateCollection(array $data): array;

    public function hydrate(array $data): EntityInterface;

    public function extract(EntityDataInterface $entity): array;
}
