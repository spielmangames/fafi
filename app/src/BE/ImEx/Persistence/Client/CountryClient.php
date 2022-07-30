<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence\Client;

use FAFI\src\BE\Domain\Geo\Country;
use FAFI\src\BE\Domain\Geo\GeoService;

class CountryClient implements EntityClientInterface
{
    private GeoService $countryService;

    public function __construct()
    {
        $this->countryService = new GeoService();
    }


    public function create($entity): Country
    {
        return $this->countryService->getCountryRepo()->save($entity);
    }

    public function update($entity): Country
    {
        return $this->countryService->getCountryRepo()->save($entity);
    }
}
