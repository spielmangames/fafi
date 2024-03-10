<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Player\Integration;

use FAFI\src\BE\Domain\Dto\EntityInterface;
use FAFI\src\BE\Domain\Dto\Player\Integration\PlayerIntegration;
use FAFI\src\BE\Domain\Persistence\EntityHydratorInterface;
use FAFI\src\BE\Domain\Persistence\EntityValidator;

class PlayerIntegrationHydrator implements EntityHydratorInterface
{
    /**
     * @param array $data
     *
     * @return PlayerIntegration[]
     */
    public function hydrateCollection(array $data): array
    {
        return array_map(
            fn(array $row): PlayerIntegration => $this->hydrate($row),
            $data
        );


//        $hydrated = [];
//        foreach ($data as $row) {
//            $hydrated[] = $this->hydrate($row);
//        }
//
//        return $hydrated;
    }

    public function hydrate(array $data): PlayerIntegration
    {
        $id = (int)$data[PlayerIntegrationResource::ID_FIELD];

        $playerId = $data[PlayerIntegrationResource::PLAYER_ID_FIELD];
        $tmarkt = $data[PlayerIntegrationResource::TMARKT_FIELD];

        return new PlayerIntegration(
            $id,
            $playerId,
            $tmarkt
        );
    }

    public function dehydrate(EntityInterface $entity): array
    {
        EntityValidator::assertEntityType(PlayerIntegration::class, $entity);
        /** @var PlayerIntegration $entity */

        return [
            PlayerIntegrationResource::ID_FIELD => $entity->getId(),

            PlayerIntegrationResource::PLAYER_ID_FIELD => $entity->getPlayerId(),
            PlayerIntegrationResource::TMARKT_FIELD => $entity->getTmarkt(),
        ];
    }
}
