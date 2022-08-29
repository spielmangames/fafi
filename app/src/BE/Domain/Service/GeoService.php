<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Service;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\Geo\Country\Country;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;
use FAFI\src\BE\Domain\Persistence\Geo\City\CityRepository;
use FAFI\src\BE\Domain\Persistence\Geo\Country\CountryRepository;

class GeoService
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
