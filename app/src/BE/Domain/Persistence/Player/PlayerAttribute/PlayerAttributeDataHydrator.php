<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Player\PlayerAttribute;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Player\PlayerAttribute\PlayerAttribute;
use FAFI\src\BE\Domain\Dto\Player\PlayerAttribute\PlayerAttributeData;
use FAFI\src\BE\Domain\Persistence\EntityDataHydratorInterface;
use FAFI\src\BE\Domain\Persistence\EntityValidator;
use FAFI\src\BE\Domain\Persistence\EntityHydratorInterface;

class PlayerAttributeDataHydrator implements EntityDataHydratorInterface
{
//    /**
//     * @param array $data
//     *
//     * @return PlayerAttribute[]
//     */
//    public function hydrateCollection(array $data): array
//    {
//        $hydrated = [];
//        foreach ($data as $row) {
//            $hydrated[] = $this->hydrate($row);
//        }
//
//        return $hydrated;
//    }
//
//    public function hydrate(array $data): PlayerAttribute
//    {
//        $id = (int)$data[PlayerAttributeResource::ID_FIELD];
//
//        $playerId = (int)$data[PlayerAttributeResource::PLAYER_ID_FIELD];
//        $positionId = (int)$data[PlayerAttributeResource::POSITION_ID_FIELD];
//
//        $attMin = (int)$data[PlayerAttributeResource::ATT_MIN_FIELD];
//        $attMax = (int)$data[PlayerAttributeResource::ATT_MAX_FIELD];
//        $defMin = (int)$data[PlayerAttributeResource::DEF_MIN_FIELD];
//        $defMax = (int)$data[PlayerAttributeResource::DEF_MAX_FIELD];
//
//        return new PlayerAttribute(
//            $id,
//            $playerId,
//            $positionId,
//            $attMin,
//            $attMax,
//            $defMin,
//            $defMax
//        );
//    }

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
