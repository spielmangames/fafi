<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Team\PlayerClub;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Team\PlayerClub\PlayerClubData;
use FAFI\src\BE\Domain\Persistence\EntityDataHydratorInterface;
use FAFI\src\BE\Domain\Persistence\EntityValidator;

class PlayerClubDataHydrator implements EntityDataHydratorInterface
{
    /**
     * @param array $data
     *
     * @return PlayerClubData[]
     */
    public function hydrateCollection(array $data): array
    {
        return array_map(
            fn(array $row): PlayerClubData => $this->hydrate($row),
            $data
        );


//        $hydrated = [];
//        foreach ($data as $row) {
//            $hydrated[] = $this->hydrate($row);
//        }
//
//        return $hydrated;
    }

    public function hydrate(array $data): PlayerClubData
    {
        $clubData = new PlayerClubData();

        return $clubData
            ->setId($data[PlayerClubResource::ID_FIELD] ?? null)
            ->setClubId($data[PlayerClubResource::CLUB_ID_FIELD] ?? null)
            ->setNum($data[PlayerClubResource::NUM_FIELD] ?? null)
            ->setPlayerId($data[PlayerClubResource::PLAYER_ID_FIELD] ?? null);
    }

    public function dehydrate(EntityDataInterface $entity): array
    {
        EntityValidator::assertEntityType(PlayerClubData::class, $entity);
        /** @var PlayerClubData $entity */

        return [
            PlayerClubResource::ID_FIELD => $entity->getId(),

            PlayerClubResource::CLUB_ID_FIELD => $entity->getClubId(),
            PlayerClubResource::NUM_FIELD => $entity->getNum(),
            PlayerClubResource::PLAYER_ID_FIELD => $entity->getPlayerId(),
        ];
    }
}
