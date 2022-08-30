<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Hydrator;

use FAFI\src\BE\Domain\Dto\EntityInterface;

interface EntityHydratorInterface
{
    public function hydrate(array $data): EntityInterface;
//    public function dehydrate(EntityInterface $entity): array;
}
