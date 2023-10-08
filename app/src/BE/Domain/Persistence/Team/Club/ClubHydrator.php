<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Team\Club;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Team\Club\Club;
use FAFI\src\BE\Domain\Dto\Team\Club\ClubData;
use FAFI\src\BE\Domain\Persistence\EntityValidator;
use FAFI\src\BE\Domain\Persistence\EntityHydratorInterface;

class ClubHydrator implements EntityHydratorInterface
{
    /**
     * @param array $data
     *
     * @return Club[]
     */
    public function hydrateCollection(array $data): array
    {
        $hydrated = [];
        foreach ($data as $row) {
            $hydrated[] = $this->hydrate($row);
        }

        return $hydrated;
    }

    public function hydrate(array $data): Club
    {
        $id = (int)$data[ClubResource::ID_FIELD];

        $name = $data[ClubResource::NAME_FIELD];
        $fafiName = $data[ClubResource::FAFI_NAME_FIELD];
        $cityId = (int)$data[ClubResource::CITY_ID_FIELD];
        $founded = (int)$data[ClubResource::FOUNDED_FIELD] ?? null;

        return new Club(
            $id,
            $name,
            $fafiName,
            $cityId,
            $founded
        );
    }

    public function extract(EntityDataInterface $entity): array
    {
        EntityValidator::assertEntityType(ClubData::class, $entity);
        /** @var ClubData $entity */

        return [
            ClubResource::ID_FIELD => $entity->getId(),

            ClubResource::NAME_FIELD => $entity->getName(),
        ];
    }
}
