<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence\Client;

use FAFI\src\BE\Domain\GeoCountry\CountryService;

class CountryClient implements EntityClientInterface
{
    private CountryService $countryService;

    public function __construct()
    {
        $this->countryService = new CountryService();
    }


    public function create($entity): int
    {
        return $this->countryService->getCountryRepo()->save($entity)->getId();
    }

    public function update($entity)
    {
        $this->countryService->getCountryRepo()->save($entity);
    }
}
