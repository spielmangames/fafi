<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Transformer\Hydrator;

use FAFI\src\GeoCountry\Country;
use FAFI\src\ImEx\Transformer\Schema\CountryFileSchema;

class CountryTrHydrator
{
    /**
     * @param array $data
     *
     * @return Country[]
     */
    public function hydrateCollection(array $data): array
    {
        $transformed = [];
        foreach ($data as $row) {
            $entity = $this->hydrate($row);
            $transformed[] = $entity;
        }

        return $transformed;
    }

    /**
     * @param array $data
     *
     * @return Country
     */
    public function hydrate(array $data): Country
    {
        return new Country(
            isset($data[CountryFileSchema::ID]) ? (int)$data[CountryFileSchema::ID] : null,

            $data[CountryFileSchema::NAME]
        );
    }


    public function extract(Country $position): array
    {
        return [
            CountryFileSchema::ID => $position->getId(),

            CountryFileSchema::NAME => $position->getName(),
        ];
    }
}
