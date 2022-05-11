<?php

namespace FAFI\BE\GeoCountry\Repository;

use FAFI\BE\GeoCountry\Country;
use FAFI\exception\FafiException;

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
            $e = sprintf(FafiException::E_REQ_MISSED, Country::ENTITY, implode('", "', $missed));
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
