<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Hydrator;

use FAFI\src\BE\Domain\Dto\Geo\Country\Country;
use FAFI\src\BE\ImEx\FileSchemas\Entity\CountryEntityFileSchema;

class CountryHydrator implements EntityHydratorInterface
{
    public function hydrate(array $data): Country
    {
        $country = new Country();

        !isset($data[CountryEntityFileSchema::ID]) ?: $country->setId($data[CountryEntityFileSchema::ID]);

        !isset($data[CountryEntityFileSchema::NAME]) ?: $country->setName($data[CountryEntityFileSchema::NAME]);
        !isset($data[CountryEntityFileSchema::CONTINENT]) ?: $country->setContinent($data[CountryEntityFileSchema::CONTINENT]);

        return $country;
    }

    public function dehydrate(Country $entity): array
    {
        return [
            CountryEntityFileSchema::ID => $entity->getId(),

            CountryEntityFileSchema::NAME => $entity->getName(),
            CountryEntityFileSchema::CONTINENT => $entity->getContinent(),
        ];
    }
}
