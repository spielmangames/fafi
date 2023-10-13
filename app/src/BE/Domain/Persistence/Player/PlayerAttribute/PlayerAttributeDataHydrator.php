<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Player\PlayerAttribute;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Player\PlayerAttribute\PlayerAttributeData;
use FAFI\src\BE\Domain\Persistence\EntityDataHydratorInterface;
use FAFI\src\BE\Domain\Persistence\EntityValidator;

class PlayerAttributeDataHydrator implements EntityDataHydratorInterface
{
    /**
     * @param array $data
     *
     * @return PlayerAttributeData[]
     */
    public function hydrateCollection(array $data): array
    {
        $hydrated = [];
        foreach ($data as $row) {
            $hydrated[] = $this->hydrate($row);
        }

        return $hydrated;
    }

    public function hydrate(array $data): PlayerAttributeData
    {
        $playerAttributeData = new PlayerAttributeData();

        $id = (int)$data[PlayerAttributeResource::ID_FIELD] ?? null;

        $playerId = (int)$data[PlayerAttributeResource::PLAYER_ID_FIELD] ?? null;
        $positionId = (int)$data[PlayerAttributeResource::POSITION_ID_FIELD] ?? null;

        $attMin = (int)$data[PlayerAttributeResource::ATT_MIN_FIELD] ?? null;
        $attMax = (int)$data[PlayerAttributeResource::ATT_MAX_FIELD] ?? null;
        $defMin = (int)$data[PlayerAttributeResource::DEF_MIN_FIELD] ?? null;
        $defMax = (int)$data[PlayerAttributeResource::DEF_MAX_FIELD] ?? null;

        return $playerAttributeData
            ->setId($id)
            ->setPlayerId($playerId)
            ->setPositionId($positionId)
            ->setAttMin($attMin)
            ->setAttMax($attMax)
            ->setDefMin($defMin)
            ->setDefMax($defMax);
    }

    public function dehydrate(EntityDataInterface $entity): array
    {
        EntityValidator::assertEntityType(PlayerAttributeData::class, $entity);
        /** @var PlayerAttributeData $entity */

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
