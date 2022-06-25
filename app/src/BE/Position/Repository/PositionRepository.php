<?php

namespace FAFI\src\BE\Position\Repository;

use FAFI\db\Query\QuerySyntax;
use FAFI\exception\FafiException;
use FAFI\src\BE\Player\Repository\Criteria;
use FAFI\src\BE\Position\Position;
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
        $criteria = new Criteria(AbstractResource::ID_FIELD, QuerySyntax::OPERATOR_IS, [$id]);
        return $this->positionResource->readFirst([$criteria]);
    }

    /**
     * @param string $name
     *
     * @return Position|null
     * @throws FafiException
     */
    public function findByName(string $name): ?Position
    {
        $criteria = new Criteria(PositionResource::NAME_FIELD, QuerySyntax::OPERATOR_IS, [$name]);
        return $this->positionResource->readFirst([$criteria]);
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return Position[]
     * @throws FafiException
     */
    public function findCollection(array $conditions): array
    {
        return $this->positionResource->read($conditions);
    }

    /**
     * @param Position $position
     *
     * @return Position
     * @throws FafiException
     */
    public function save(Position $position): Position
    {
        return $position->getId() ? $this->positionResource->update($position) : $this->positionResource->create($position);
    }
}
