<?php

namespace FAFI\entity\Position;

use FAFI\entity\Position\Repository\PositionCriteria;
use FAFI\entity\Position\Repository\PositionRepository;
use FAFI\exception\FafiException;

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
    public function create(Position $position): Position
    {
        return $this->positionRepository->save($position);
    }

    /**
     * @param PositionsFilter $filter
     * @return Position[]
     * @throws FafiException
     */
    public function read(PositionsFilter $filter): array
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
