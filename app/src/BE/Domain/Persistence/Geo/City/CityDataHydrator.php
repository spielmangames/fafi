<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Geo\City;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Geo\City\CityData;
use FAFI\src\BE\Domain\Persistence\EntityDataHydratorInterface;
use FAFI\src\BE\Domain\Persistence\EntityValidator;

class CityDataHydrator implements EntityDataHydratorInterface
{
    /**
     * @param array $data
     *
     * @return CityData[]
     */
    public function hydrateCollection(array $data): array
    {
        $hydrated = [];
        foreach ($data as $row) {
            $hydrated[] = $this->hydrate($row);
        }

        return $hydrated;
    }

    public function hydrate(array $data): CityData
    {
        $cityData = new CityData();

        $id = (int)$data[CityResource::ID_FIELD] ?? null;

        $name = (string)$data[CityResource::NAME_FIELD] ?? null;
        $countryId = (int)$data[CityResource::COUNTRY_ID_FIELD] ?? null;

        return $cityData
            ->setId($id)
            ->setName($name)
            ->setCountryId($countryId);
    }

    public function dehydrate(EntityDataInterface $entity): array
    {
        EntityValidator::assertEntityType(CityData::class, $entity);
        /** @var CityData $entity */

        return [
            CityResource::ID_FIELD => $entity->getId(),

            CityResource::NAME_FIELD => $entity->getName(),
            CityResource::COUNTRY_ID_FIELD => $entity->getCountryId(),
        ];
    }
}
