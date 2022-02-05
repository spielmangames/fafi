<?php

namespace FAFI\entity\Player\Repository;

use FAFI\entity\Player\Player;
use FAFI\exception\FafiException;

class PlayerHydrator
{
    private array $requiredFields = [
        PlayerResource::SURNAME_FIELD,
        PlayerResource::FAFI_SURNAME_FIELD,
    ];


    /**
     * @param array $data
     * @return Player
     * @throws FafiException
     */
    public function hydrate(array $data): Player
    {
        $this->checkRequiredFields($data);

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

    /**
     * @param array $data
     *
     * @return void
     * @throws FafiException
     */
    private function validateRequiredFieldsOnHydration(array $data): void
    {
        $missed = [];
        foreach ($this->requiredFields as $field) {
            if (!isset($data[$field])) {
                $missed[] = $field;
            }
        }

        if (!empty($missed)) {
            $e = sprintf(FafiException::E_REQ_MISSED, Player::ENTITY, implode('", "', $missed));
            throw new FafiException($e);
        }
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
