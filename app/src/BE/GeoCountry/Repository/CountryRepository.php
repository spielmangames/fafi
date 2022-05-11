<?php

namespace FAFI\src\BE\GeoCountry\Repository;

use FAFI\exception\FafiException;
use FAFI\src\BE\GeoCountry\Country;

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
        $criteria = new CountryCriteria([$id]);
        return $this->countryResource->readFirst($criteria);
    }

    /**
     * @param CountryCriteria $criteria
     *
     * @return Country[]
     * @throws FafiException
     */
    public function findCollection(CountryCriteria $criteria): array
    {
        return $this->countryResource->read($criteria);
    }

    /**
     * @param Country $player
     *
     * @return Country
     * @throws FafiException
     */
    public function save(Country $player): Country
    {
        return $player->getId() ? $this->countryResource->update($player) : $this->countryResource->create($player);
    }
}
