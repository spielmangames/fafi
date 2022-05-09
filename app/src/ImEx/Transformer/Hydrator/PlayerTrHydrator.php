<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Transformer\Hydrator;

use FAFI\src\ImEx\Transformer\Schema\File\PlayerFileSchema;
use FAFI\src\Player\Player;

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

        $data = $this->hydrateFields($data);

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

    private function hydrateFields(array $fields)
    {
        $result = [];

        foreach ($fields as $fieldName => $fieldValue) {
            $result = $this->addHydratedField($result, $fieldName, $fieldValue);
        }

        return $result;
    }

    private function addHydratedField(array $model, string $fieldName, $fieldValue): array
    {
        if(array_key)

        return $model;
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
