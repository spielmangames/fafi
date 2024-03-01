<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Player\Integration;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Player\Integration\PlayerIntegrationData;
use FAFI\src\BE\Domain\Persistence\EntityDataHydratorInterface;
use FAFI\src\BE\Domain\Persistence\EntityValidator;

class IntegrationDataHydrator implements EntityDataHydratorInterface
{
    /**
     * @param array $data
     *
     * @return PlayerIntegrationData[]
     */
    public function hydrateCollection(array $data): array
    {
        $hydrated = [];
        foreach ($data as $row) {
            $hydrated[] = $this->hydrate($row);
        }

        return $hydrated;
    }

    public function hydrate(array $data): PlayerIntegrationData
    {
        $playerIntegrationData = new PlayerIntegrationData();

        return $playerIntegrationData
            ->setId($data[IntegrationResource::ID_FIELD] ?? null)
            ->setPlayerId($data[IntegrationResource::PLAYER_ID_FIELD] ?? null)
            ->setTmarkt($data[IntegrationResource::TMARKT_FIELD] ?? null);
    }

    public function dehydrate(EntityDataInterface $entity): array
    {
        EntityValidator::assertEntityType(PlayerIntegrationData::class, $entity);
        /** @var PlayerIntegrationData $entity */

        return [
            IntegrationResource::ID_FIELD => $entity->getId(),

            IntegrationResource::PLAYER_ID_FIELD => $entity->getPlayerId(),
            IntegrationResource::TMARKT_FIELD => $entity->getTmarkt(),
        ];
    }
}
