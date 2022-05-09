<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Transformer\Hydrator;

use FAFI\src\Position\Position;

class PositionTrHydrator
{
    /**
     * @param array $data
     *
     * @return Position[]
     */
    public function hydrateCollection(array $data): array
    {
        $transformed = [];
        foreach ($data as $row) {
            $entity = $this->hydrate($row);
            $transformed[] = $entity;
        }

        return $transformed;
    }

    /**
     * @param array $data
     *
     * @return Position
     */
    public function hydrate(array $data): Position
    {
        return new Position(
            isset($data[PositionFileSchema::ID]) ? (int)$data[PositionFileSchema::ID] : null,

            $data[PositionFileSchema::NAME]
        );
    }


    public function extract(Position $position): array
    {
        return [
            PositionFileSchema::ID => $position->getId(),

            PositionFileSchema::NAME => $position->getName(),
        ];
    }
}
