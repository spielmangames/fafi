<?php

declare(strict_types=1);

namespace FAFI\entity\ImEx\Transformer\Hydrator;

use FAFI\entity\ImEx\Transformer\Schema\PlayerFileSchema;
use FAFI\entity\Player\Player;

class PlayerTrHydrator
{
    /**
     * @param array $data
     *
     * @return Player[]
     */
    public function hydrateCollection(array $data): array
    {
        $transformed = [];
        foreach ($data as $row) {
            $entity = $this->hydrate($row);
            $transformed[] = $entity;
        }

        return $transformed;
    }

    /**
     * @param array $data
     *
     * @return Player
     */
    public function hydrate(array $data): Player
    {
        $attributes = null;

        return new Player(
            isset($data[PlayerFileSchema::ID]) ? $data[PlayerFileSchema::ID] : null,

            $data[PlayerFileSchema::NAME],
            $data[PlayerFileSchema::PARTICLE],
            $data[PlayerFileSchema::SURNAME],
            $data[PlayerFileSchema::FAFI_SURNAME],

            $data[PlayerFileSchema::HEIGHT],
            $data[PlayerFileSchema::FOOT],
            $data[PlayerFileSchema::INJURE_FACTOR],

            $attributes
        );
    }


    public function extract(Player $position): array
    {
        return [
            PlayerFileSchema::ID => $position->getId(),

            PlayerFileSchema::NAME => $position->getName(),
            PlayerFileSchema::PARTICLE => $position->getParticle(),
            PlayerFileSchema::SURNAME => $position->getSurname(),
            PlayerFileSchema::FAFI_SURNAME => $position->getFafiSurname(),

            PlayerFileSchema::HEIGHT => $position->getHeight(),
            PlayerFileSchema::FOOT => $position->getFoot(),
            PlayerFileSchema::INJURE_FACTOR => $position->getInjureFactor(),
        ];
    }
}
