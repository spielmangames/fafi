<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Geo\Country;

use FAFI\src\BE\Domain\Dto\EntityInterface;
use FAFI\src\BE\Domain\Dto\Geo\Country\Country;
use FAFI\src\BE\Domain\Persistence\EntityValidator;
use FAFI\src\BE\Domain\Persistence\EntityHydratorInterface;

class CountryHydrator implements EntityHydratorInterface
{
    /**
     * @param array $data
     *
     * @return Country[]
     */
    public function hydrateCollection(array $data): array
    {
        return array_map(
            fn(array $row): Country => $this->hydrate($row),
            $data
        );


//        $hydrated = [];
//        foreach ($data as $row) {
//            $hydrated[] = $this->hydrate($row);
//        }
//
//        return $hydrated;
    }

    public function hydrate(array $data): Country
    {
        $id = (int)$data[CountryResource::ID_FIELD];

        $name = $data[CountryResource::NAME_FIELD];
        $continent = $data[CountryResource::CONTINENT_FIELD];

        return new Country(
            $id,
            $name,
            $continent
        );
    }

    public function dehydrate(EntityInterface $entity): array
    {
        EntityValidator::assertEntityType(Country::class, $entity);
        /** @var Country $entity */

        return [
            CountryResource::ID_FIELD => $entity->getId(),

            CountryResource::NAME_FIELD => $entity->getName(),
            CountryResource::CONTINENT_FIELD => $entity->getContinent(),
        ];
    }
}
