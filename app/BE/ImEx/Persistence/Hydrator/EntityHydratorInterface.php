<?php

declare(strict_types=1);

namespace FAFI\BE\ImEx\Persistence\Hydrator;

use FAFI\BE\Structure\EntityInterface;

interface EntityHydratorInterface
{
    public function hydrate(array $entity): EntityInterface;
}
