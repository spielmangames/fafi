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
        $hydrated = [];
        foreach ($data as $row) {
            $hydrated[] = $this->hydrate($row);
        }

        return $hydrated;
    }

    public function hydrate(array $data): CountryData
    {
        $countryData = new CountryData();

        $id = (int)$data[CountryResource::ID_FIELD] ?? null;

        $name = (string)$data[CountryResource::NAME_FIELD] ?? null;
        $continent = (string)$data[CountryResource::CONTINENT_FIELD] ?? null;

        return $countryData
            ->setId($id)
            ->setName($name)
            ->setContinent($continent);
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
