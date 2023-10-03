<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Hydrator;

use FAFI\src\BE\Domain\Dto\Player\Player\Player;
use FAFI\src\BE\ImEx\FileSchemas\Entity\PlayerEntityFileSchema;

class PlayerHydrator implements EntityHydratorInterface
{
    private PlayerAttributeHydrator $playerAttributeHydrator;

    public function __construct()
    {
        $this->playerAttributeHydrator = new PlayerAttributeHydrator();
    }


    public function hydrate(array $data): Player
    {
        $player = new Player();

        !isset($data[PlayerEntityFileSchema::ID]) ?: $player->setId($data[PlayerEntityFileSchema::ID]);

        !isset($data[PlayerEntityFileSchema::NAME]) ?: $player->setName($data[PlayerEntityFileSchema::NAME]);
        !isset($data[PlayerEntityFileSchema::PARTICLE]) ?: $player->setParticle($data[PlayerEntityFileSchema::PARTICLE]);
        !isset($data[PlayerEntityFileSchema::SURNAME]) ?: $player->setSurname($data[PlayerEntityFileSchema::SURNAME]);
        !isset($data[PlayerEntityFileSchema::FAFI_SURNAME]) ?: $player->setFafiSurname($data[PlayerEntityFileSchema::FAFI_SURNAME]);

        !isset($data[PlayerEntityFileSchema::HEIGHT]) ?: $player->setHeight($data[PlayerEntityFileSchema::HEIGHT]);
        !isset($data[PlayerEntityFileSchema::FOOT]) ?: $player->setFoot($data[PlayerEntityFileSchema::FOOT]);
        !isset($data[PlayerEntityFileSchema::INJURE_FACTOR]) ?: $player->setIsFragile($data[PlayerEntityFileSchema::INJURE_FACTOR]);

        !isset($data[PlayerEntityFileSchema::ATTRIBUTES]) ?: $player->setAttributes(
            $this->playerAttributeHydrator->hydrateCollection($data[PlayerEntityFileSchema::ATTRIBUTES])
        );

        return $player;
    }


    public function dehydrate(Player $entity): array
    {
        return [
            PlayerEntityFileSchema::ID => $entity->getId(),

            PlayerEntityFileSchema::NAME => $entity->getName(),
            PlayerEntityFileSchema::PARTICLE => $entity->getParticle(),
            PlayerEntityFileSchema::SURNAME => $entity->getSurname(),
            PlayerEntityFileSchema::FAFI_SURNAME => $entity->getFafiSurname(),

            PlayerEntityFileSchema::HEIGHT => $entity->getHeight(),
            PlayerEntityFileSchema::FOOT => $entity->getFoot(),
            PlayerEntityFileSchema::INJURE_FACTOR => $entity->getIsFragile(),

            PlayerEntityFileSchema::ATTRIBUTES => $entity->getAttributes(),
        ];
    }
}
