<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Geo\Country;

use FAFI\db\Query\QuerySyntax;
use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Criteria;
use FAFI\src\BE\Domain\Dto\Geo\Country\Country;
use FAFI\src\BE\Domain\Persistence\AbstractResource;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;
use FAFI\src\BE\RepositoryInterface;

class CountryRepository implements RepositoryInterface
{
    private CountryResource $countryResource;

    public function __construct()
    {
        $this->countryResource = new CountryResource();
    }


    /**
     * @param int $id
     *
     * @return Country|null
     * @throws FafiException
     */
    public function findById(int $id): ?Country
    {
        $criteria = new Criteria(AbstractResource::ID_FIELD, QuerySyntax::OPERATOR_IS, [$id]);
        return $this->countryResource->readFirst([$criteria]);
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return Country[]
     * @throws FafiException
     */
    public function findCollection(array $conditions): array
    {
        return $this->countryResource->read($conditions);
    }

    /**
     * @param string $name
     *
     * @return Country|null
     * @throws FafiException
     */
    public function findByName(string $name): ?Country
    {
        $criteria = new Criteria(CountryResource::NAME_FIELD, QuerySyntax::OPERATOR_IS, [$name]);
        return $this->countryResource->readFirst([$criteria]);
    }


    /**
     * @param Country $entity
     *
     * @return Country
     * @throws FafiException
     */
    public function save($entity): Country
    {
        return $entity->getId() ? $this->countryResource->update($entity) : $this->countryResource->create($entity);
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
        $this->countryResource->delete([$criteria]);
    }
}
