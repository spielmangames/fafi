<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Geo\City;

use FAFI\src\BE\Domain\Dto\Geo\City\City;
use FAFI\src\BE\Domain\Persistence\HydratorInterface;

class CityHydrator implements HydratorInterface
{
    /**
     * @param array $data
     *
     * @return City[]
     */
    public function hydrateCollection(array $data): array
    {
        $hydrated = [];
        foreach ($data as $row) {
            $hydrated[] = $this->hydrate($row);
        }

        return $hydrated;
    }

    public function hydrate(array $data): City
    {
        $city = new City();

        !isset($data[CityResource::ID_FIELD]) ?: $city->setId($data[CityResource::ID_FIELD]);

        !isset($data[CityResource::NAME_FIELD]) ?: $city->setName($data[CityResource::NAME_FIELD]);

        return $city;
    }

    public function extract(City $city): array
    {
        return [
            CityResource::ID_FIELD => $city->getId(),

            CityResource::NAME_FIELD => $city->getName(),
        ];
    }
}
