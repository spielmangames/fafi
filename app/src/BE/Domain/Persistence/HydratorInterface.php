<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence;

use FAFI\src\BE\Domain\Dto\EntityInterface;

interface HydratorInterface
{
    /**
     * @param array[] $data
     *
     * @return EntityInterface[]
     */
    public function hydrateCollection(array $data): array;

    public function hydrate(array $data): EntityInterface;
}
