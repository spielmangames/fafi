<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence\Hydrator;

use FAFI\src\BE\GeoCountry\Country;
use FAFI\src\BE\ImEx\Transformer\Schema\File\CountryFileSchema;

class CountryHydrator implements EntityHydratorInterface
{
    public function hydrate(array $data): Country
    {
        $country = new Country();

        !isset($data[CountryFileSchema::ID]) ?: $country->setId($data[CountryFileSchema::ID]);

        !isset($data[CountryFileSchema::NAME]) ?: $country->setName($data[CountryFileSchema::NAME]);

        return $country;
    }

    public function extract(Country $entity): array
    {
        return [
            CountryFileSchema::ID => $entity->getId(),

            CountryFileSchema::NAME => $entity->getName(),
        ];
    }
}