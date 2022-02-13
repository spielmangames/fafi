<?php

namespace FAFI\entity\ImEx\Transformer;

use FAFI\entity\GeoCountry\Country;
use FAFI\exception\FafiException;

class CountryTrHydrator
{
    /**
     * @param array $data
     *
     * @return Country[]
     * @throws FafiException
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
