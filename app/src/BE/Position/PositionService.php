<?php

namespace FAFI\src\BE\Position;

use FAFI\exception\FafiException;
use FAFI\src\BE\Position\Repository\PositionCriteria;
use FAFI\src\BE\Position\Repository\PositionRepository;
use FAFI\src\BE\Position\Repository\PositionsFilter;

class PositionService
{
    private PositionRepository $positionRepository;

    public function __construct()
    {
        $this->positionRepository = new PositionRepository();
    }


    /**
     * @param Position $position
     * @return Position
     * @throws FafiException
     */
    public function createPosition(Position $position): Position
    {
        return $this->positionRepository->save($position);
    }

    /**
     * @param PositionsFilter $filter
     * @return Position[]
     * @throws FafiException
     */
    public function readPositions(PositionsFilter $filter): array
    {
        $criteria = new PositionCriteria($filter->getPositionIds());
        return $this->positionRepository->findCollection($criteria);
    }

    public function update()
    {
        // TO BE IMPLEMENTED
    }

    public function delete()
    {
        // TO BE IMPLEMENTED
    }
}
