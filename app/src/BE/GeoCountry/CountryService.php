<?php

namespace FAFI\src\BE\GeoCountry;

use FAFI\BE\GeoCountry\CountryFilter;
use FAFI\exception\FafiException;
use FAFI\src\BE\GeoCountry\Repository\CountryCriteria;
use FAFI\src\BE\GeoCountry\Repository\CountryRepository;

class CountryService
{
    private CountryRepository $countryRepository;

    public function __construct()
    {
        $this->countryRepository = new CountryRepository();
    }


    /**
     * @param Country $country
     * @return Country
     * @throws FafiException
     */
    public function createCountry(Country $country): Country
    {
        return $this->countryRepository->save($country);
    }

    /**
     * @param CountryFilter $filter
     * @return Country[]
     * @throws FafiException
     */
    public function readCountries(CountryFilter $filter): array
    {
        $criteria = new CountryCriteria($filter->getIds());
        return $this->countryRepository->findCollection($criteria);
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
