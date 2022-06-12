<?php

namespace FAFI\src\BE\GeoCountry\Repository;

use FAFI\exception\EntityErr;
use FAFI\exception\FafiException;
use FAFI\src\BE\GeoCountry\Country;

class CountryHydrator
{
    private array $requiredFields = [
        CountryResource::NAME_FIELD,
    ];


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
     * @throws FafiException
     */
    public function hydrate(array $data): Country
    {
        $this->validateRequiredFieldsOnHydration($data);

        return new Country(
            isset($data[CountryResource::ID_FIELD]) ? (int)$data[CountryResource::ID_FIELD] : null,

            $data[CountryResource::NAME_FIELD],
        );
    }

    /**
     * @param array $data
     *
     * @return void
     * @throws FafiException
     */
    private function validateRequiredFieldsOnHydration(array $data): void
    {
        $missed = [];
        foreach ($this->requiredFields as $field) {
            if (!isset($data[$field])) {
                $missed[] = $field;
            }
        }

        if (!empty($missed)) {
            $e = sprintf(EntityErr::REQ_MISSED, Country::ENTITY, implode('", "', $missed));
            throw new FafiException($e);
        }
    }

    public function extract(Country $entity): array
    {
        return [
            CountryResource::ID_FIELD => $entity->getId(),

            CountryResource::NAME_FIELD => $entity->getName(),
        ];
    }
}
