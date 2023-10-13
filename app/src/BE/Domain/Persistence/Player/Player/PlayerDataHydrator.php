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

        $id = (int)$data[PlayerResource::ID_FIELD] ?? null;

        $name = (string)$data[PlayerResource::NAME_FIELD] ?? null;
        $particle = (string)$data[PlayerResource::PARTICLE_FIELD] ?? null;
        $surname = (string)$data[PlayerResource::SURNAME_FIELD] ?? null;
        $fafiSurname = (string)$data[PlayerResource::FAFI_SURNAME_FIELD] ?? null;

        $height = (int)$data[PlayerResource::HEIGHT_FIELD] ?? null;
        $foot = (string)$data[PlayerResource::FOOT_FIELD] ?? null;
        $isFragile = (bool)$data[PlayerResource::IS_FRAGILE_FIELD] ?? null;

        return $playerData
            ->setId($id)
            ->setName($name)
            ->setParticle($particle)
            ->setSurname($surname)
            ->setFafiSurname($fafiSurname)
            ->setHeight($height)
            ->setFoot($foot)
            ->setIsFragile($isFragile);
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

            PlayerResource::HEIGHT_FIELD => $entity->getHeight(),
            PlayerResource::FOOT_FIELD => $entity->getFoot(),
            PlayerResource::IS_FRAGILE_FIELD => $entity->getIsFragile(),
        ];
    }
}
