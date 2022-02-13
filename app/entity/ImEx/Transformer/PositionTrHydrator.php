<?php

namespace FAFI\entity\ImEx\Transformer;

use FAFI\entity\Position\Position;
use FAFI\entity\Position\PositionService;
use FAFI\entity\Position\Repository\PositionHydrator;
use FAFI\exception\FafiException;

class PositionTrHydrator
{
    private PositionHydrator $positionHydrator;
    private PositionService $positionService;

    public function __construct()
    {
        $this->positionHydrator = new PositionHydrator();
        $this->positionService = new PositionService();
    }


    /**
     * @param array $data
     *
     * @return Position[]
     * @throws FafiException
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
     * @throws FafiException
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
