<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Player\Player;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Player\Player\Player;
use FAFI\src\BE\Domain\Persistence\EntityValidator;
use FAFI\src\BE\Domain\Persistence\HydratorInterface;

class PlayerHydrator implements HydratorInterface
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
        $player = new Player();

        !isset($data[PlayerResource::ID_FIELD]) ?: $player->setId($data[PlayerResource::ID_FIELD]);

        !isset($data[PlayerResource::NAME_FIELD]) ?: $player->setName($data[PlayerResource::NAME_FIELD]);
        !isset($data[PlayerResource::PARTICLE_FIELD]) ?: $player->setParticle($data[PlayerResource::PARTICLE_FIELD]);
        !isset($data[PlayerResource::SURNAME_FIELD]) ?: $player->setSurname($data[PlayerResource::SURNAME_FIELD]);
        !isset($data[PlayerResource::FAFI_SURNAME_FIELD]) ?: $player->setFafiSurname($data[PlayerResource::FAFI_SURNAME_FIELD]);

        !isset($data[PlayerResource::HEIGHT_FIELD]) ?: $player->setHeight($data[PlayerResource::HEIGHT_FIELD]);
        !isset($data[PlayerResource::FOOT_FIELD]) ?: $player->setFoot($data[PlayerResource::FOOT_FIELD]);
        !isset($data[PlayerResource::INJURE_FACTOR_FIELD]) ?: $player->setInjureFactor($data[PlayerResource::INJURE_FACTOR_FIELD]);

        return $player;
    }

    public function extract(EntityDataInterface $entity): array
    {
        EntityValidator::verifyInterface(PlayerData::class, $entity);
        /** @var PlayerData $entity */

        return [
            PlayerResource::ID_FIELD => $entity->getId(),

            PlayerResource::NAME_FIELD => $entity->getName(),
            PlayerResource::PARTICLE_FIELD => $entity->getParticle(),
            PlayerResource::SURNAME_FIELD => $entity->getSurname(),
            PlayerResource::FAFI_SURNAME_FIELD => $entity->getFafiSurname(),

            PlayerResource::HEIGHT_FIELD => $entity->getHeight(),
            PlayerResource::FOOT_FIELD => $entity->getFoot(),
            PlayerResource::INJURE_FACTOR_FIELD => $entity->getInjureFactor(),
        ];
    }
}
