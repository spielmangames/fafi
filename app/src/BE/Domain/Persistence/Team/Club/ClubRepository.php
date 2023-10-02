<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Team\Club;

use FAFI\db\Query\QuerySyntax;
use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Criteria;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Team\Club\Club;
use FAFI\src\BE\Domain\Dto\Team\Club\ClubData;
use FAFI\src\BE\Domain\Persistence\AbstractResource;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;
use FAFI\src\BE\RepositoryInterface;

class ClubRepository implements RepositoryInterface
{
    private ClubResource $clubResource;

    public function __construct()
    {
        $this->clubResource = new ClubResource();
    }


    /**
     * @param int $id
     *
     * @return Club|null
     * @throws FafiException
     */
    public function findById(int $id): ?Club
    {
        $criteria = new Criteria(AbstractResource::ID_FIELD, QuerySyntax::OPERATOR_IS, [$id]);
        return $this->clubResource->read([$criteria]);
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return Club[]
     * @throws FafiException
     */
    public function findCollection(array $conditions): array
    {
        return $this->clubResource->list($conditions);
    }


    /**
     * @param ClubData $entity
     *
     * @return Club
     * @throws FafiException
     */
    public function save(EntityDataInterface $entity): Club
    {
        return $entity->getId() ? $this->clubResource->update($entity) : $this->clubResource->create($entity);
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
        $this->clubResource->delete([$criteria]);
    }
}
