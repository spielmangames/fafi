<?php

namespace FAFI\src\BE\Player\Repository;

use FAFI\exception\FafiException;
use FAFI\src\BE\Player\Player;
use FAFI\src\BE\PlayerAttribute\Repository\PlayerAttributeHydrator;

class PlayerHydrator
{
    private PlayerAttributeHydrator $playerAttributeHydrator;

    public function __construct()
    {
        $this->playerAttributeHydrator = new PlayerAttributeHydrator();
    }


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
//        $attributes = $data['attributes'] ?? $this->playerAttributeHydrator->hydrateCollection($data['attributes']);
        $attributes = $data['attributes'] ?? null;

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

    public function extract(Player $player): array
    {
        $data = [
            PlayerResource::ID_FIELD => $player->getId(),

            PlayerResource::NAME_FIELD => $player->getName(),
            PlayerResource::PARTICLE_FIELD => $player->getParticle(),
            PlayerResource::SURNAME_FIELD => $player->getSurname(),
            PlayerResource::FAFI_SURNAME_FIELD => $player->getFafiSurname(),

            PlayerResource::HEIGHT_FIELD => $player->getHeight(),
            PlayerResource::FOOT_FIELD => $player->getFoot(),
            PlayerResource::INJURE_FACTOR_FIELD => $player->getInjureFactor(),
        ];

        return $data;
    }
}
