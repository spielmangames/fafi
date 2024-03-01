<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Player\Player;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Player\Player\PlayerData;
use FAFI\src\BE\Domain\Persistence\EntityDataHydratorInterface;
use FAFI\src\BE\Domain\Persistence\EntityValidator;

class PlayerDataHydrator implements EntityDataHydratorInterface
{
    /**
     * @param array $data
     *
     * @return PlayerData[]
     */
    public function hydrateCollection(array $data): array
    {
        $hydrated = [];
        foreach ($data as $row) {
            $hydrated[] = $this->hydrate($row);
        }

        return $hydrated;
    }

    public function hydrate(array $data): PlayerData
    {
        $playerData = new PlayerData();

        return $playerData
            ->setId($data[PlayerResource::ID_FIELD] ?? null)
            ->setName($data[PlayerResource::NAME_FIELD] ?? null)
            ->setParticle($data[PlayerResource::PARTICLE_FIELD] ?? null)
            ->setSurname($data[PlayerResource::SURNAME_FIELD] ?? null)
            ->setFafiSurname($data[PlayerResource::FAFI_SURNAME_FIELD] ?? null)
            ->setNationality($data[PlayerResource::NATIONALITY_FIELD] ?? null)
            ->setFoot($data[PlayerResource::FOOT_FIELD] ?? null)
            ->setHeight($data[PlayerResource::HEIGHT_FIELD] ?? null)
            ->setIsFragile($data[PlayerResource::IS_FRAGILE_FIELD] ?? null);
    }

    public function dehydrate(EntityDataInterface $entity): array
    {
        EntityValidator::assertEntityType(PlayerData::class, $entity);
        /** @var PlayerData $entity */

        return [
            PlayerResource::ID_FIELD => $entity->getId(),

            PlayerResource::NAME_FIELD => $entity->getName(),
            PlayerResource::PARTICLE_FIELD => $entity->getParticle(),
            PlayerResource::SURNAME_FIELD => $entity->getSurname(),
            PlayerResource::FAFI_SURNAME_FIELD => $entity->getFafiSurname(),

            PlayerResource::NATIONALITY_FIELD => $entity->getNationality(),

            PlayerResource::FOOT_FIELD => $entity->getFoot(),
            PlayerResource::HEIGHT_FIELD => $entity->getHeight(),
            PlayerResource::IS_FRAGILE_FIELD => $entity->getIsFragile(),
        ];
    }
}
