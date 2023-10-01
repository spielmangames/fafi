<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Player\Position;

use FAFI\src\BE\Domain\Dto\Player\Position\Position;
use FAFI\src\BE\Domain\Persistence\HydratorInterface;

class PositionHydrator implements HydratorInterface
{
    /**
     * @param array $data
     *
     * @return Position[]
     */
    public function hydrateCollection(array $data): array
    {
        $hydrated = [];
        foreach ($data as $row) {
            $hydrated[] = $this->hydrate($row);
        }

        return $hydrated;
    }

    public function hydrate(array $data): Position
    {
        $position = new Position();

        !isset($data[PositionResource::ID_FIELD]) ?: $position->setId($data[PositionResource::ID_FIELD]);

        !isset($data[PositionResource::NAME_FIELD]) ?: $position->setName($data[PositionResource::NAME_FIELD]);

        return $position;
    }

    public function extract(Position $entity): array
    {
        return [
            PositionResource::ID_FIELD => $entity->getId(),

            PositionResource::NAME_FIELD => $entity->getName(),
        ];
    }
}
