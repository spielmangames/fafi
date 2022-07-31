<?php

namespace FAFI\src\BE\Domain\Persistence\Geo\Country;

use FAFI\src\BE\Domain\Dto\Geo\Country\Country;

class CountryHydrator
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

        return $country;
    }

    public function extract(Country $country): array
    {
        return [
            CountryResource::ID_FIELD => $country->getId(),

            CountryResource::NAME_FIELD => $country->getName(),
        ];
    }
}
