<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence\Hydrator;

use FAFI\src\BE\ImEx\Transformer\Schema\File\PlayerFileSchema;
use FAFI\src\BE\Player\Player;

class PlayerHydrator implements EntityHydratorInterface
{
    public function hydrate(array $entity): Player
    {
        $player = new Player();

        if (array_key_exists(PlayerFileSchema::ID, $entity)) {
            $player->setId($entity[PlayerFileSchema::ID]);
        }

        if (array_key_exists(PlayerFileSchema::NAME, $entity)) {
            $player->setName($entity[PlayerFileSchema::NAME]);
        }
        if (array_key_exists(PlayerFileSchema::PARTICLE, $entity)) {
            $player->setParticle($entity[PlayerFileSchema::PARTICLE]);
        }
        if (array_key_exists(PlayerFileSchema::SURNAME, $entity)) {
            $player->setSurname($entity[PlayerFileSchema::SURNAME]);
        }
        if (array_key_exists(PlayerFileSchema::FAFI_SURNAME, $entity)) {
            $player->setFafiSurname($entity[PlayerFileSchema::FAFI_SURNAME]);
        }

        if (array_key_exists(PlayerFileSchema::HEIGHT, $entity)) {
            $player->setHeight($entity[PlayerFileSchema::HEIGHT]);
        }
        if (array_key_exists(PlayerFileSchema::FOOT, $entity)) {
            $player->setFoot($entity[PlayerFileSchema::FOOT]);
        }
        if (array_key_exists(PlayerFileSchema::INJURE_FACTOR, $entity)) {
            $player->setInjureFactor($entity[PlayerFileSchema::INJURE_FACTOR]);
        }

        return $player;
    }
}
