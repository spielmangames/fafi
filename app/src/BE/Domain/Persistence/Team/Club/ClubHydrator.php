<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Team\Club;

use FAFI\src\BE\Domain\Dto\Team\Club\Club;

class ClubHydrator
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
        $club = new Club();

        !isset($data[ClubResource::ID_FIELD]) ?: $club->setId($data[ClubResource::ID_FIELD]);

        !isset($data[ClubResource::NAME_FIELD]) ?: $club->setName($data[ClubResource::NAME_FIELD]);

        return $club;
    }

    public function extract(Club $club): array
    {
        return [
            ClubResource::ID_FIELD => $club->getId(),

            ClubResource::NAME_FIELD => $club->getName(),
        ];
    }
}
