<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Player\Player;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Player\Player\Player;
use FAFI\src\BE\Domain\Dto\Player\Player\PlayerData;
use FAFI\src\BE\Domain\Persistence\EntityValidator;
use FAFI\src\BE\Domain\Persistence\EntityHydratorInterface;

class PlayerHydrator implements EntityHydratorInterface
{
    /**
     * @param array $data
     *
     * @return Player[]
     */
    public function hydrateCollection(array $data): array
    {
        $hydrated = [];
        foreach ($data as $row) {
            $hydrated[] = $this->hydrate($row);
        }

        return $hydrated;
    }

    public function hydrate(array $data): Player
    {
        $id = (int)$data[PlayerResource::ID_FIELD];

        $name = $data[PlayerResource::NAME_FIELD];
        $particle = $data[PlayerResource::PARTICLE_FIELD];
        $surname = $data[PlayerResource::SURNAME_FIELD];
        $fafiSurname = $data[PlayerResource::FAFI_SURNAME_FIELD];

        $height = (int)$data[PlayerResource::HEIGHT_FIELD];
        $foot = $data[PlayerResource::FOOT_FIELD];
        $isFragile = (bool)$data[PlayerResource::IS_FRAGILE_FIELD];

        return new Player(
            $id,
            $name,
            $particle,
            $surname,
            $fafiSurname,
            $height,
            $foot,
            $isFragile
        );
    }

    public function extract(EntityDataInterface $entity): array
    {
        EntityValidator::assertEntityType(PlayerData::class, $entity);
        /** @var PlayerData $entity */

        return [
            PlayerResource::ID_FIELD => $entity->getId(),

            PlayerResource::NAME_FIELD => $entity->getName(),
            PlayerResource::PARTICLE_FIELD => $entity->getParticle(),
            PlayerResource::SURNAME_FIELD => $entity->getSurname(),
            PlayerResource::FAFI_SURNAME_FIELD => $entity->getFafiSurname(),

            PlayerResource::HEIGHT_FIELD => $entity->getHeight(),
            PlayerResource::FOOT_FIELD => $entity->getFoot(),
            PlayerResource::IS_FRAGILE_FIELD => $entity->getIsFragile(),
        ];
    }
}
