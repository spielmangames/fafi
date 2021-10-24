<?php

namespace FAFI\entity\Player;

use Exception;
use FAFI\entity\Player\Repository\PlayerResource;

class PlayerHydrator
{
    private array $requiredFields = [
        PlayerResource::SURNAME_FIELD,
        PlayerResource::FAFI_SURNAME_FIELD,
    ];

    public function hydrate(array $data): Player
    {
        if (!$this->checkRequiredFields($data)) {
            throw new Exception('Required fields are missed.');
        }

        return new Player(
            isset($data[PlayerResource::ID_FIELD]) ? (int)$data[PlayerResource::ID_FIELD] : null,

            $data[PlayerResource::NAME_FIELD],
            $data[PlayerResource::PARTICLE_FIELD],
            $data[PlayerResource::SURNAME_FIELD],
            $data[PlayerResource::FAFI_SURNAME_FIELD],
//            $data[PlayerResource::BIRTH_COUNTRY_FIELD],
//            $data[PlayerResource::BIRTH_CITY_FIELD],
//            $data[PlayerResource::BIRTH_DATE_FIELD],

            $data[PlayerResource::HEIGHT_FIELD],
            $data[PlayerResource::FOOT_FIELD],
            $data[PlayerResource::INJURE_FACTOR_FIELD]
        );
    }

    private function checkRequiredFields(array $data): bool
    {
        foreach ($this->requiredFields as $field) {
            if (!isset($data[$field])) {
                return false;
            }
        }

        return true;
    }

    public function extract(Player $player): array
    {
        return [
            PlayerResource::ID_FIELD => $player->getId(),

            PlayerResource::NAME_FIELD => $player->getName(),
            PlayerResource::PARTICLE_FIELD => $player->getParticle(),
            PlayerResource::SURNAME_FIELD => $player->getSurname(),
            PlayerResource::FAFI_SURNAME_FIELD => $player->getFafiSurname(),
//            PlayerResource::BIRTH_COUNTRY_FIELD => $player->getBirthCountry(),
//            PlayerResource::BIRTH_CITY_FIELD => $player->getBirthCity(),
//            PlayerResource::BIRTH_DATE_FIELD => $player->getBirthDate(),

            PlayerResource::HEIGHT_FIELD => $player->getHeight(),
            PlayerResource::FOOT_FIELD => $player->getFoot(),
            PlayerResource::INJURE_FACTOR_FIELD => $player->getInjureFactor(),
        ];
    }
}
