<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Persistence\Hydrator;

use FAFI\src\Structure\EntityInterface;

interface EntityHydratorInterface
{
    public function hydrate(array $entity): EntityInterface;
}
