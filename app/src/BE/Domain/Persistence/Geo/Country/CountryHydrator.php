<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Geo\Country;

use FAFI\src\BE\Domain\Dto\Geo\Country\Country;
use FAFI\src\BE\Domain\Persistence\HydratorInterface;

class CountryHydrator implements HydratorInterface
{
    /**
     * @param array $data
     *
     * @return Country[]
     */
    public function hydrateCollection(array $data): array
    {
        $hydrated = [];
        foreach ($data as $row) {
            $hydrated[] = $this->hydrate($row);
        }

        return $hydrated;
    }

    public function hydrate(array $data): Country
    {
        $country = new Country();

        !isset($data[CountryResource::ID_FIELD]) ?: $country->setId($data[CountryResource::ID_FIELD]);

        !isset($data[CountryResource::NAME_FIELD]) ?: $country->setName($data[CountryResource::NAME_FIELD]);
        !isset($data[CountryResource::CONTINENT_FIELD]) ?: $country->setContinent($data[CountryResource::CONTINENT_FIELD]);

        return $country;
    }

    public function extract(Country $country): array
    {
        return [
            CountryResource::ID_FIELD => $country->getId(),

            CountryResource::NAME_FIELD => $country->getName(),
            CountryResource::CONTINENT_FIELD => $country->getContinent(),
        ];
    }
}
