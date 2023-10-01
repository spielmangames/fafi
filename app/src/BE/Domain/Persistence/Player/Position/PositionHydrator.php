<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Player\Position;

use FAFI\src\BE\Domain\Dto\Player\Position\Position;
use FAFI\src\BE\Domain\Dto\Player\Position\PositionData;
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
        $id = (int)$data[PositionResource::ID_FIELD];

        $name = $data[PositionResource::NAME_FIELD];

        return new Position(
            $id,
            $name
        );
    }

    public function extract(PositionData $entity): array
    {
        return [
            PositionResource::ID_FIELD => $entity->getId(),

            PositionResource::NAME_FIELD => $entity->getName(),
        ];
    }
}
