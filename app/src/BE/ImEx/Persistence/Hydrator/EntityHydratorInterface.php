<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence\Hydrator;

use FAFI\src\BE\Domain\EntityInterface;

interface EntityHydratorInterface
{
    public function hydrate(array $data): EntityInterface;
//    public function extract(EntityInterface $entity): array;
}
