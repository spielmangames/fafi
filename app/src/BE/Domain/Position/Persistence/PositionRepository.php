<?php

namespace FAFI\src\BE\Domain\Position\Persistence;

use FAFI\db\Query\QuerySyntax;
use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Position\Position;
use FAFI\src\BE\Structure\Repository\AbstractResource;
use FAFI\src\BE\Structure\Repository\EntityCriteriaInterface;

class PositionRepository
{
    private PositionResource $positionResource;

    public function __construct()
    {
        $this->positionResource = new PositionResource();
    }


    /**
     * @param int $id
     *
     * @return Position|null
     * @throws FafiException
     */
    public function findById(int $id): ?Position
    {
        $criteria = new \FAFI\src\BE\Domain\Criteria(AbstractResource::ID_FIELD, QuerySyntax::OPERATOR_IS, [$id]);
        return $this->positionResource->readFirst([$criteria]);
    }

    /**
     * @param string $name
     *
     * @return \FAFI\src\BE\Domain\Position\Position|null
     * @throws FafiException
     */
    public function findByName(string $name): ?Position
    {
        $criteria = new \FAFI\src\BE\Domain\Criteria(PositionResource::NAME_FIELD, QuerySyntax::OPERATOR_IS, [$name]);
        return $this->positionResource->readFirst([$criteria]);
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return \FAFI\src\BE\Domain\Position\Position[]
     * @throws FafiException
     */
    public function findCollection(array $conditions): array
    {
        return $this->positionResource->read($conditions);
    }

    /**
     * @param Position $position
     *
     * @return \FAFI\src\BE\Domain\Position\Position
     * @throws FafiException
     */
    public function save(Position $position): Position
    {
        return $position->getId() ? $this->positionResource->update($position) : $this->positionResource->create($position);
    }
}
