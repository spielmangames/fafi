<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Clients;

use FAFI\src\BE\Domain\Dto\Geo\City\City;
use FAFI\src\BE\Domain\Service\GeoService;

class CityClient implements EntityClientInterface
{
    private GeoService $geoService;

    public function __construct()
    {
        $this->geoService = new GeoService();
    }


    public function create($entity): City
    {
        return $this->geoService->saveCity($entity);
    }

    public function update($entity): City
    {
        return $this->geoService->saveCity($entity);
    }
}
