<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Schema\Mapper;

use FAFI\src\BE\Domain\Persistence\Player\Integration\PlayerIntegrationResource;
use FAFI\src\BE\ImEx\Schema\FileSchema\Entity\PlayerIntegrationEntityFileSchema;

class PlayerIntegrationMapper extends AbstractImExableEntityMapper implements ImExableEntityMapperInterface
{
    private const MAP = [
        PlayerIntegrationEntityFileSchema::ID => PlayerIntegrationResource::ID_FIELD,

        PlayerIntegrationEntityFileSchema::PLAYER => PlayerIntegrationResource::PLAYER_ID_FIELD,
        PlayerIntegrationEntityFileSchema::TMARKT => PlayerIntegrationResource::TMARKT_FIELD,
    ];

    public function getMap(): array
    {
        return self::MAP;
    }
}
