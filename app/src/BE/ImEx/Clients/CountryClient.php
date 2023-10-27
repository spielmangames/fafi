<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Clients;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Geo\Country\Country;
use FAFI\src\BE\Domain\Dto\Geo\Country\CountryData;
use FAFI\src\BE\Domain\Service\GeoService;

class CountryClient implements EntityClientInterface
{
    private GeoService $geoService;

    public function __construct()
    {
        $this->geoService = new GeoService();
    }


    public function save(EntityDataInterface $entity): Country
    {
        /** @var CountryData $entity */
        return $this->geoService->saveCountry($entity);
    }
}
