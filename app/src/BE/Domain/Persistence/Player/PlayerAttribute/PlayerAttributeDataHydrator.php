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
        return array_map(
            fn(array $row): PlayerAttributeData => $this->hydrate($row),
            $data
        );


//        $hydrated = [];
//        foreach ($data as $row) {
//            $hydrated[] = $this->hydrate($row);
//        }
//
//        return $hydrated;
    }

    public function hydrate(array $data): PlayerAttributeData
    {
        $playerAttributeData = new PlayerAttributeData();

        return $playerAttributeData
            ->setId($data[PlayerAttributeResource::ID_FIELD] ?? null)
            ->setPlayerId($data[PlayerAttributeResource::PLAYER_ID_FIELD] ?? null)
            ->setPositionId($data[PlayerAttributeResource::POSITION_ID_FIELD] ?? null)
            ->setAttMin($data[PlayerAttributeResource::ATT_MIN_FIELD] ?? null)
            ->setAttMax($data[PlayerAttributeResource::ATT_MAX_FIELD] ?? null)
            ->setDefMin($data[PlayerAttributeResource::DEF_MIN_FIELD] ?? null)
            ->setDefMax($data[PlayerAttributeResource::DEF_MAX_FIELD] ?? null);
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
