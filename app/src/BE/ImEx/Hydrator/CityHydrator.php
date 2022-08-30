<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Hydrator;

use FAFI\src\BE\Domain\Dto\Geo\City\City;
use FAFI\src\BE\ImEx\FileSchemas\Entity\CityEntityFileSchema;

class CityHydrator implements EntityHydratorInterface
{
    public function hydrate(array $data): City
    {
        $country = new City();

        !isset($data[CityEntityFileSchema::ID]) ?: $country->setId($data[CityEntityFileSchema::ID]);

        !isset($data[CityEntityFileSchema::NAME]) ?: $country->setName($data[CityEntityFileSchema::NAME]);

        return $country;
    }

    public function dehydrate(City $entity): array
    {
        return [
            CityEntityFileSchema::ID => $entity->getId(),

            CityEntityFileSchema::NAME => $entity->getName(),
        ];
    }
}
