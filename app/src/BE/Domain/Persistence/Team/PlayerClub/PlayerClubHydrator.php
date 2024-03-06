<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Team\PlayerClub;

use FAFI\src\BE\Domain\Dto\EntityInterface;
use FAFI\src\BE\Domain\Dto\Team\PlayerClub\PlayerClub;
use FAFI\src\BE\Domain\Persistence\EntityHydratorInterface;
use FAFI\src\BE\Domain\Persistence\EntityValidator;

class PlayerClubHydrator implements EntityHydratorInterface
{
    /**
     * @param array $data
     *
     * @return PlayerClub[]
     */
    public function hydrateCollection(array $data): array
    {
        return array_map(
            fn(array $row): PlayerClub => $this->hydrate($row),
            $data
        );


//        $hydrated = [];
//        foreach ($data as $row) {
//            $hydrated[] = $this->hydrate($row);
//        }
//
//        return $hydrated;
    }

    public function hydrate(array $data): PlayerClub
    {
        $id = (int)$data[PlayerClubResource::ID_FIELD];

        $clubId = (int)$data[PlayerClubResource::CLUB_ID_FIELD];
        $num = (int)$data[PlayerClubResource::NUM_FIELD];
        $playerId = (int)$data[PlayerClubResource::PLAYER_ID_FIELD];

        return new PlayerClub(
            $id,
            $clubId,
            $num,
            $playerId,
        );
    }

    public function dehydrate(EntityInterface $entity): array
    {
        EntityValidator::assertEntityType(PlayerClub::class, $entity);
        /** @var PlayerClub $entity */

        return [
            PlayerClubResource::ID_FIELD => $entity->getId(),

            PlayerClubResource::CLUB_ID_FIELD => $entity->getClubId(),
            PlayerClubResource::NUM_FIELD => $entity->getNum(),
            PlayerClubResource::PLAYER_ID_FIELD => $entity->getPlayerId(),
        ];
    }
}
