<?php

namespace FAFI\src\BE\GeoCountry;

use FAFI\src\BE\GeoCountry\Repository\CountryRepository;

class CountryService
{
    private CountryRepository $countryRepository;

    public function __construct()
    {
        $this->countryRepository = new CountryRepository();
    }


    public function getCountryRepo(): CountryRepository
    {
        return $this->countryRepository;
    }
}
