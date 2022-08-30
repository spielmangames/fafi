<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence\Hydrator;

use FAFI\src\BE\Domain\Dto\Player\Player\Player;
use FAFI\src\BE\ImEx\Transformer\Schema\File\PlayerFileSchema;

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

        !isset($data[PlayerFileSchema::ID]) ?: $player->setId($data[PlayerFileSchema::ID]);

        !isset($data[PlayerFileSchema::NAME]) ?: $player->setName($data[PlayerFileSchema::NAME]);
        !isset($data[PlayerFileSchema::PARTICLE]) ?: $player->setParticle($data[PlayerFileSchema::PARTICLE]);
        !isset($data[PlayerFileSchema::SURNAME]) ?: $player->setSurname($data[PlayerFileSchema::SURNAME]);
        !isset($data[PlayerFileSchema::FAFI_SURNAME]) ?: $player->setFafiSurname($data[PlayerFileSchema::FAFI_SURNAME]);

        !isset($data[PlayerFileSchema::HEIGHT]) ?: $player->setHeight($data[PlayerFileSchema::HEIGHT]);
        !isset($data[PlayerFileSchema::FOOT]) ?: $player->setFoot($data[PlayerFileSchema::FOOT]);
        !isset($data[PlayerFileSchema::INJURE_FACTOR]) ?: $player->setInjureFactor($data[PlayerFileSchema::INJURE_FACTOR]);

        !isset($data[PlayerFileSchema::ATTRIBUTES]) ?: $player->setAttributes(
            $this->playerAttributeHydrator->hydrateCollection($data[PlayerFileSchema::ATTRIBUTES])
        );

        return $player;
    }


    public function dehydrate(Player $entity): array
    {
        return [
            PlayerFileSchema::ID => $entity->getId(),

            PlayerFileSchema::NAME => $entity->getName(),
            PlayerFileSchema::PARTICLE => $entity->getParticle(),
            PlayerFileSchema::SURNAME => $entity->getSurname(),
            PlayerFileSchema::FAFI_SURNAME => $entity->getFafiSurname(),

            PlayerFileSchema::HEIGHT => $entity->getHeight(),
            PlayerFileSchema::FOOT => $entity->getFoot(),
            PlayerFileSchema::INJURE_FACTOR => $entity->getInjureFactor(),

            PlayerFileSchema::ATTRIBUTES => $entity->getAttributes(),
        ];
    }
}
