<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Geo\City;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Geo\City\City;
use FAFI\src\BE\Domain\Dto\Geo\City\CityData;
use FAFI\src\BE\Domain\Persistence\EntityValidator;
use FAFI\src\BE\Domain\Persistence\EntityHydratorInterface;

class CityHydrator implements EntityHydratorInterface
{
    /**
     * @param array $data
     *
     * @return City[]
     */
    public function hydrateCollection(array $data): array
    {
        $hydrated = [];
        foreach ($data as $row) {
            $hydrated[] = $this->hydrate($row);
        }

        return $hydrated;
    }

    public function hydrate(array $data): City
    {
        $id = (int)$data[CityResource::ID_FIELD];

        $name = $data[CityResource::NAME_FIELD];
        $countryId = (int)$data[CityResource::COUNTRY_ID_FIELD];

        return new City(
            $id,
            $name,
            $countryId
        );
    }

    public function extract(EntityDataInterface $entity): array
    {
        EntityValidator::assertEntityType(CityData::class, $entity);
        /** @var CityData $entity */

        return [
            CityResource::ID_FIELD => $entity->getId(),

            CityResource::NAME_FIELD => $entity->getName(),
        ];
    }
}
