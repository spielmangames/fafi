<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Clients;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Geo\City\City;
use FAFI\src\BE\Domain\Dto\Geo\City\CityData;
use FAFI\src\BE\Domain\Service\GeoService;

class CityClient implements EntityClientInterface
{
    private GeoService $geoService;

    public function __construct()
    {
        $this->geoService = new GeoService();
    }


    public function save(EntityDataInterface $entity): City
    {
        /** @var CityData $entity */
        return $this->geoService->saveCity($entity);
    }
}
