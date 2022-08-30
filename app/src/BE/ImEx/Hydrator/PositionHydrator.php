<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Hydrator;

use FAFI\src\BE\Domain\Dto\Player\Position\Position;
use FAFI\src\BE\ImEx\FileSchemas\Entity\PositionEntityFileSchema;

class PositionHydrator implements EntityHydratorInterface
{
    public function hydrate(array $data): Position
    {
        $position = new Position();

        !isset($data[PositionEntityFileSchema::ID]) ?: $position->setId($data[PositionEntityFileSchema::ID]);

        !isset($data[PositionEntityFileSchema::NAME]) ?: $position->setName($data[PositionEntityFileSchema::NAME]);

        return $position;
    }

    public function dehydrate(Position $entity): array
    {
        return [
            PositionEntityFileSchema::ID => $entity->getId(),

            PositionEntityFileSchema::NAME => $entity->getName(),
        ];
    }
}
