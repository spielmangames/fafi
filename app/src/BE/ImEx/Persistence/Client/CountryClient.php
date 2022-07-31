<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence\Client;

use FAFI\src\BE\Domain\Dto\Geo\Country\Country;
use FAFI\src\BE\Domain\Service\GeoService;

class CountryClient implements EntityClientInterface
{
    private GeoService $geoService;

    public function __construct()
    {
        $this->geoService = new GeoService();
    }


    public function create($entity): Country
    {
        return $this->geoService->saveCountry($entity);
    }

    public function update($entity): Country
    {
        return $this->geoService->saveCountry($entity);
    }
}
