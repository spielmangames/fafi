<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence\Hydrator;

use FAFI\src\BE\Domain\Dto\Geo\Country\Country;
use FAFI\src\BE\ImEx\Transformer\Schema\File\CountryFileSchema;

class CountryHydrator implements EntityHydratorInterface
{
    public function hydrate(array $data): Country
    {
        $country = new Country();

        !isset($data[CountryFileSchema::ID]) ?: $country->setId($data[CountryFileSchema::ID]);

        !isset($data[CountryFileSchema::NAME]) ?: $country->setName($data[CountryFileSchema::NAME]);
        !isset($data[CountryFileSchema::CONTINENT]) ?: $country->setContinent($data[CountryFileSchema::CONTINENT]);

        return $country;
    }

    public function dehydrate(Country $entity): array
    {
        return [
            CountryFileSchema::ID => $entity->getId(),

            CountryFileSchema::NAME => $entity->getName(),
            CountryFileSchema::CONTINENT => $entity->getContinent(),
        ];
    }
}
