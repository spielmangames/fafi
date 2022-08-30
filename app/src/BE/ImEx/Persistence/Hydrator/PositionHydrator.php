<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence\Hydrator;

use FAFI\src\BE\Domain\Dto\Player\Position\Position;
use FAFI\src\BE\ImEx\Transformer\Schema\File\PositionFileSchema;

class PositionHydrator implements EntityHydratorInterface
{
    public function hydrate(array $data): Position
    {
        $position = new Position();

        !isset($data[PositionFileSchema::ID]) ?: $position->setId($data[PositionFileSchema::ID]);

        !isset($data[PositionFileSchema::NAME]) ?: $position->setName($data[PositionFileSchema::NAME]);

        return $position;
    }

    public function dehydrate(Position $entity): array
    {
        return [
            PositionFileSchema::ID => $entity->getId(),

            PositionFileSchema::NAME => $entity->getName(),
        ];
    }
}
