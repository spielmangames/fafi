<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Geo\City;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Geo\City\City;
use FAFI\src\BE\Domain\Dto\Geo\City\CityData;
use FAFI\src\BE\Domain\Persistence\EntityDataHydratorInterface;
use FAFI\src\BE\Domain\Persistence\EntityValidator;

class CityDataHydrator implements EntityDataHydratorInterface
{
//    /**
//     * @param array $data
//     *
//     * @return City[]
//     */
//    public function hydrateCollection(array $data): array
//    {
//        $hydrated = [];
//        foreach ($data as $row) {
//            $hydrated[] = $this->hydrate($row);
//        }
//
//        return $hydrated;
//    }

//    public function hydrate(array $data): City
//    {
//        $id = (int)$data[CityResource::ID_FIELD];
//
//        $name = $data[CityResource::NAME_FIELD];
//        $countryId = (int)$data[CityResource::COUNTRY_ID_FIELD];
//
//        return new City(
//            $id,
//            $name,
//            $countryId
//        );
//    }

    public function dehydrate(EntityDataInterface $entity): array
    {
        EntityValidator::assertEntityType(CityData::class, $entity);
        /** @var CityData $entity */

        return [
            CityResource::ID_FIELD => $entity->getId(),

            CityResource::NAME_FIELD => $entity->getName(),
        ];
    }
}
