<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Service;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\Geo\City\City;
use FAFI\src\BE\Domain\Dto\Geo\Country\Country;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;
use FAFI\src\BE\Domain\Persistence\Geo\City\CityRepository;
use FAFI\src\BE\Domain\Persistence\Geo\Country\CountryRepository;

class GeoService implements ServiceInterface
{
    private CountryRepository $countryRepository;
    private CityRepository $cityRepository;

    public function __construct()
    {
        $this->countryRepository = new CountryRepository();
        $this->cityRepository = new CityRepository();
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
     * @param string $name
     *
     * @return Country|null
     * @throws FafiException
     */
    public function findCountryByName(string $name): ?Country
    {
        return $this->countryRepository->findByName($name);
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


    /**
     * @param int $id
     *
     * @return City|null
     * @throws FafiException
     */
    public function findCityById(int $id): ?City
    {
        return $this->cityRepository->findById($id);
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return City[]
     * @throws FafiException
     */
    public function findCitiesCollection(array $conditions): array
    {
        return $this->cityRepository->findCollection($conditions);
    }

    /**
     * @param string $name
     *
     * @return City|null
     * @throws FafiException
     */
    public function findCityByName(string $name): ?City
    {
        return $this->cityRepository->findByName($name);
    }


    /**
     * @param City $city
     *
     * @return City
     * @throws FafiException
     */
    public function saveCity(City $city): City
    {
        return $this->cityRepository->save($city);
    }
}
