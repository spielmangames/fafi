<?php

namespace FAFI\src\BE\PlayerAttribute\Repository;

use FAFI\exception\EntityErr;
use FAFI\exception\FafiException;
use FAFI\src\BE\PlayerAttribute\PlayerAttribute;

class PlayerAttributeHydrator
{
    private array $requiredFields = [
        PlayerAttributeResource::PLAYER_ID_FIELD,
        PlayerAttributeResource::POSITION_ID_FIELD,
    ];


    /**
     * @param array $data
     *
     * @return PlayerAttribute[]
     * @throws FafiException
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
     * @return PlayerAttribute
     * @throws FafiException
     */
    public function hydrate(array $data): PlayerAttribute
    {
        $this->validateRequiredFieldsOnHydration($data);

        return new PlayerAttribute(
            isset($data[PlayerAttributeResource::ID_FIELD]) ? (int)$data[PlayerAttributeResource::ID_FIELD] : null,

            $data[PlayerAttributeResource::PLAYER_ID_FIELD],
            $data[PlayerAttributeResource::POSITION_ID_FIELD],

            $data[PlayerAttributeResource::ATT_MIN_FIELD],
            $data[PlayerAttributeResource::ATT_MAX_FIELD],
            $data[PlayerAttributeResource::DEF_MIN_FIELD],
            $data[PlayerAttributeResource::DEF_MAX_FIELD],
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
            $e = sprintf(EntityErr::REQ_MISSED, PlayerAttribute::ENTITY, implode('", "', $missed));
            throw new FafiException($e);
        }
    }


    public function extract(PlayerAttribute $entity): array
    {
        return [
            PlayerAttributeResource::ID_FIELD => $entity->getId(),

            PlayerAttributeResource::PLAYER_ID_FIELD => $entity->getPlayerId(),
            PlayerAttributeResource::POSITION_ID_FIELD => $entity->getPositionId(),

            PlayerAttributeResource::ATT_MIN_FIELD => $entity->getAttMin(),
            PlayerAttributeResource::ATT_MAX_FIELD => $entity->getAttMax(),
            PlayerAttributeResource::DEF_MIN_FIELD => $entity->getDefMin(),
            PlayerAttributeResource::DEF_MAX_FIELD => $entity->getDefMax(),
        ];
    }
}
