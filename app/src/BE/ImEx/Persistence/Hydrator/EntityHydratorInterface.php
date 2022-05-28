<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence\Hydrator;

use FAFI\src\BE\Structure\EntityInterface;

interface EntityHydratorInterface
{
    public function hydrate(array $entity): EntityInterface;
}