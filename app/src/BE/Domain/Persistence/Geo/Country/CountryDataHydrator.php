<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Geo\Country;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Geo\Country\Country;
use FAFI\src\BE\Domain\Dto\Geo\Country\CountryData;
use FAFI\src\BE\Domain\Persistence\EntityDataHydratorInterface;
use FAFI\src\BE\Domain\Persistence\EntityValidator;
use FAFI\src\BE\Domain\Persistence\EntityHydratorInterface;

class CountryDataHydrator implements EntityDataHydratorInterface
{
//    /**
//     * @param array $data
//     *
//     * @return Country[]
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
//
//    public function hydrate(array $data): Country
//    {
//        $id = (int)$data[CountryResource::ID_FIELD];
//
//        $name = $data[CountryResource::NAME_FIELD];
//        $continent = $data[CountryResource::CONTINENT_FIELD];
//
//        return new Country(
//            $id,
//            $name,
//            $continent
//        );
//    }

    public function dehydrate(EntityDataInterface $entity): array
    {
        EntityValidator::assertEntityType(CountryData::class, $entity);
        /** @var CountryData $entity */

        return [
            CountryResource::ID_FIELD => $entity->getId(),

            CountryResource::NAME_FIELD => $entity->getName(),
            CountryResource::CONTINENT_FIELD => $entity->getContinent(),
        ];
    }
}
