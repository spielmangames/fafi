<?php

namespace FAFI\src\BE\Domain\GeoCountry\Repository;

use FAFI\db\Query\QuerySyntax;
use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\GeoCountry\Country;
use FAFI\src\BE\Domain\Persistence\AbstractResource;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;

class CountryRepository
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
        $criteria = new \FAFI\src\BE\Domain\Criteria(AbstractResource::ID_FIELD, QuerySyntax::OPERATOR_IS, [$id]);
        return $this->countryResource->readFirst([$criteria]);
    }

    /**
     * @param \FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface[] $conditions
     *
     * @return Country[]
     * @throws FafiException
     */
    public function findCollection(array $conditions): array
    {
        return $this->countryResource->read($conditions);
    }

    /**
     * @param Country $country
     *
     * @return \FAFI\src\BE\Domain\GeoCountry\Country
     * @throws FafiException
     */
    public function save(Country $country): Country
    {
        return $country->getId() ? $this->countryResource->update($country) : $this->countryResource->create($country);
    }
}
