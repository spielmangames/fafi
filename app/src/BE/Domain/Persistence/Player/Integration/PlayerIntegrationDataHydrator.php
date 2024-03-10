<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Player\Integration;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Player\Integration\PlayerIntegrationData;
use FAFI\src\BE\Domain\Persistence\EntityDataHydratorInterface;
use FAFI\src\BE\Domain\Persistence\EntityValidator;

class PlayerIntegrationDataHydrator implements EntityDataHydratorInterface
{
    /**
     * @param array $data
     *
     * @return PlayerIntegrationData[]
     */
    public function hydrateCollection(array $data): array
    {
        return array_map(
            fn(array $row): PlayerIntegrationData => $this->hydrate($row),
            $data
        );


//        $hydrated = [];
//        foreach ($data as $row) {
//            $hydrated[] = $this->hydrate($row);
//        }
//
//        return $hydrated;
    }

    public function hydrate(array $data): PlayerIntegrationData
    {
        $playerIntegrationData = new PlayerIntegrationData();

        return $playerIntegrationData
            ->setId($data[PlayerIntegrationResource::ID_FIELD] ?? null)
            ->setPlayerId($data[PlayerIntegrationResource::PLAYER_ID_FIELD] ?? null)
            ->setTmarkt($data[PlayerIntegrationResource::TMARKT_FIELD] ?? null);
    }

    public function dehydrate(EntityDataInterface $entity): array
    {
        EntityValidator::assertEntityType(PlayerIntegrationData::class, $entity);
        /** @var PlayerIntegrationData $entity */

        return [
            PlayerIntegrationResource::ID_FIELD => $entity->getId(),

            PlayerIntegrationResource::PLAYER_ID_FIELD => $entity->getPlayerId(),
            PlayerIntegrationResource::TMARKT_FIELD => $entity->getTmarkt(),
        ];
    }
}
