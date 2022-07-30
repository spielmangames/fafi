<?php

namespace FAFI\src\BE\Domain\Geo;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Geo\Country\Country;
use FAFI\src\BE\Domain\Geo\Country\Persistence\CountryRepository;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;

class GeoService
{
    private CountryRepository $countryRepository;

    public function __construct()
    {
        $this->countryRepository = new CountryRepository();
    }


    /**
     * @param int $id
     *
     * @return Country|null
     * @throws FafiException
     */
    public function findCountryById(int $id): ?Country
    {
        return $this->countryRepository->findById($id);
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return Country[]
     * @throws FafiException
     */
    public function findCountriesCollection(array $conditions): array
    {
        return $this->countryRepository->findCollection($conditions);
    }


    /**
     * @param Country $country
     *
     * @return Country
     * @throws FafiException
     */
    public function saveCountry(Country $country): Country
    {
        return $this->countryRepository->save($country);
    }
}
