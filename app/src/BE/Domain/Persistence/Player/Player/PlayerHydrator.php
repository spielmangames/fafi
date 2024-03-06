<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Player\Player;

use FAFI\src\BE\Domain\Dto\EntityInterface;
use FAFI\src\BE\Domain\Dto\Player\Player\Player;
use FAFI\src\BE\Domain\Persistence\EntityValidator;
use FAFI\src\BE\Domain\Persistence\EntityHydratorInterface;

class PlayerHydrator implements EntityHydratorInterface
{
    /**
     * @param array $data
     *
     * @return Player[]
     */
    public function hydrateCollection(array $data): array
    {
        return array_map(
            fn(array $row): Player => $this->hydrate($row),
            $data
        );

//
//        $hydrated = [];
//        foreach ($data as $row) {
//            $hydrated[] = $this->hydrate($row);
//        }
//
//        return $hydrated;
    }

    public function hydrate(array $data): Player
    {
        $id = (int)$data[PlayerResource::ID_FIELD];

        $name = $data[PlayerResource::NAME_FIELD];
        $particle = $data[PlayerResource::PARTICLE_FIELD];
        $surname = $data[PlayerResource::SURNAME_FIELD];
        $fafiSurname = $data[PlayerResource::FAFI_SURNAME_FIELD];

        $nationality = (int)$data[PlayerResource::NATIONALITY_FIELD];

        $foot = $data[PlayerResource::FOOT_FIELD];
        $height = (int)$data[PlayerResource::HEIGHT_FIELD];
        $isFragile = (bool)$data[PlayerResource::IS_FRAGILE_FIELD];

        return new Player(
            $id,
            $name,
            $particle,
            $surname,
            $fafiSurname,
            $nationality,
            $foot,
            $height,
            $isFragile
        );
    }

    public function dehydrate(EntityInterface $entity): array
    {
        EntityValidator::assertEntityType(Player::class, $entity);
        /** @var Player $entity */

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
