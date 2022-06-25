<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence\Hydrator;

use FAFI\src\BE\PlayerAttribute\PlayerAttribute;
use FAFI\src\BE\PlayerAttribute\Repository\PlayerAttributeResource;

class PlayerAttributeHydrator implements EntityHydratorInterface
{
    /**
     * @param array $data
     *
     * @return PlayerAttribute[]
     */
    public function hydrateCollection(array $data): array
    {
        $hydrated = [];
        foreach ($data as $row) {
            $hydrated[] = $this->hydrate($row);
        }

        return $hydrated;
    }

    public function hydrate(array $data): PlayerAttribute
    {
        $attribute = new PlayerAttribute();

        !isset($data[PlayerAttributeResource::ID_FIELD]) ?: $attribute->setId($data[PlayerAttributeResource::ID_FIELD]);

        !isset($data[PlayerAttributeResource::PLAYER_ID_FIELD]) ?: $attribute->setPlayerId($data[PlayerAttributeResource::PLAYER_ID_FIELD]);
        !isset($data[PlayerAttributeResource::POSITION_ID_FIELD]) ?: $attribute->setPositionId($data[PlayerAttributeResource::POSITION_ID_FIELD]);

        !isset($data[PlayerAttributeResource::ATT_MIN_FIELD]) ?: $attribute->setAttMin($data[PlayerAttributeResource::ATT_MIN_FIELD]);
        !isset($data[PlayerAttributeResource::ATT_MAX_FIELD]) ?: $attribute->setAttMax($data[PlayerAttributeResource::ATT_MAX_FIELD]);
        !isset($data[PlayerAttributeResource::DEF_MIN_FIELD]) ?: $attribute->setDefMin($data[PlayerAttributeResource::DEF_MIN_FIELD]);
        !isset($data[PlayerAttributeResource::DEF_MAX_FIELD]) ?: $attribute->setDefMax($data[PlayerAttributeResource::DEF_MAX_FIELD]);

        return $attribute;
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
