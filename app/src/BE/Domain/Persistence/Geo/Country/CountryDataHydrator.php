<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Geo\Country;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Geo\Country\CountryData;
use FAFI\src\BE\Domain\Persistence\EntityDataHydratorInterface;
use FAFI\src\BE\Domain\Persistence\EntityValidator;

class CountryDataHydrator implements EntityDataHydratorInterface
{
    /**
     * @param array $data
     *
     * @return CountryData[]
     */
    public function hydrateCollection(array $data): array
    {
        return array_map(
            fn(array $row): CountryData => $this->hydrate($row),
            $data
        );


//        $hydrated = [];
//        foreach ($data as $row) {
//            $hydrated[] = $this->hydrate($row);
//        }
//
//        return $hydrated;
    }

    public function hydrate(array $data): CountryData
    {
        $countryData = new CountryData();

        return $countryData
            ->setId($data[CountryResource::ID_FIELD] ?? null)
            ->setName($data[CountryResource::NAME_FIELD] ?? null)
            ->setContinent($data[CountryResource::CONTINENT_FIELD] ?? null);
    }

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
