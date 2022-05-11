<?php

namespace FAFI\src\BE\Position\Repository;

use FAFI\exception\FafiException;
use FAFI\src\BE\Position\Position;

class PositionRepository
{
    private PositionResource $positionResource;

    public function __construct()
    {
        $this->positionResource = new PositionResource();
    }


//    public function delete(Position $position): bool
//    {
//        $criteria = new PositionCriteria([$position->getId()]);
//        return $this->positionResource->delete($criteria);
//    }

    /**
     * @param int $id
     * @return Position|null
     * @throws FafiException
     */
    public function findById(int $id): ?Position
    {
        $criteria = new PositionCriteria([$id]);
        return $this->positionResource->readFirst($criteria);
    }

    /**
     * @param PositionCriteria $criteria
     * @return Position[]
     * @throws FafiException
     */
    public function findCollection(PositionCriteria $criteria): array
    {
        return $this->positionResource->read($criteria);
    }

    /**
     * @param Position $position
     * @return Position
     * @throws FafiException
     */
    public function save(Position $position): Position
    {
        return $position->getId() ? $this->positionResource->update($position) : $this->positionResource->create($position);
    }
}
