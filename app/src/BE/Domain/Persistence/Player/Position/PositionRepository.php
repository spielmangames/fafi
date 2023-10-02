<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Player\Position;

use FAFI\db\Query\QuerySyntax;
use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Criteria;
use FAFI\src\BE\Domain\Dto\Player\Position\Position;
use FAFI\src\BE\Domain\Persistence\AbstractResource;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;
use FAFI\src\BE\RepositoryInterface;

class PositionRepository implements RepositoryInterface
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
        return $this->positionResource->read([$criteria]);
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
        return $this->positionResource->read([$criteria]);
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return Position[]
     * @throws FafiException
     */
    public function findCollection(array $conditions): array
    {
        return $this->positionResource->list($conditions);
    }


    /**
     * @param Position $entity
     *
     * @return Position
     * @throws FafiException
     */
    public function save($entity): Position
    {
        return $entity->getId() ? $this->positionResource->update($entity) : $this->positionResource->create($entity);
    }

    /**
     * @param int $id
     *
     * @return void
     * @throws FafiException
     */
    public function deleteById(int $id): void
    {
        $criteria = new Criteria(AbstractResource::ID_FIELD, QuerySyntax::OPERATOR_IS, [$id]);
        $this->positionResource->delete([$criteria]);
    }
}
