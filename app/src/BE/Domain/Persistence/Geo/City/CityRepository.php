<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Geo\City;

use FAFI\db\Query\QuerySyntax;
use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Criteria;
use FAFI\src\BE\Domain\Dto\Geo\City\City;
use FAFI\src\BE\Domain\Persistence\AbstractResource;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;
use FAFI\src\BE\RepositoryInterface;

class CityRepository implements RepositoryInterface
{
    private CityResource $cityResource;

    public function __construct()
    {
        $this->cityResource = new CityResource();
    }


    /**
     * @param int $id
     *
     * @return City|null
     * @throws FafiException
     */
    public function findById(int $id): ?City
    {
        $criteria = new Criteria(AbstractResource::ID_FIELD, QuerySyntax::OPERATOR_IS, [$id]);
        return $this->cityResource->readFirst([$criteria]);
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return City[]
     * @throws FafiException
     */
    public function findCollection(array $conditions): array
    {
        return $this->cityResource->read($conditions);
    }


    /**
     * @param City $entity
     *
     * @return City
     * @throws FafiException
     */
    public function save($entity): City
    {
        return $entity->getId() ? $this->cityResource->update($entity) : $this->cityResource->create($entity);
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
        $this->cityResource->delete([$criteria]);
    }
}
