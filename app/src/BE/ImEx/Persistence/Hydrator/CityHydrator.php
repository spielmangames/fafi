<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence\Hydrator;

use FAFI\src\BE\Domain\Dto\Geo\City\City;
use FAFI\src\BE\ImEx\Transformer\Schema\File\CityFileSchema;

class CityHydrator implements EntityHydratorInterface
{
    public function hydrate(array $data): City
    {
        $country = new City();

        !isset($data[CityFileSchema::ID]) ?: $country->setId($data[CityFileSchema::ID]);

        !isset($data[CityFileSchema::NAME]) ?: $country->setName($data[CityFileSchema::NAME]);

        return $country;
    }

    public function dehydrate(City $entity): array
    {
        return [
            CityFileSchema::ID => $entity->getId(),

            CityFileSchema::NAME => $entity->getName(),
        ];
    }
}
