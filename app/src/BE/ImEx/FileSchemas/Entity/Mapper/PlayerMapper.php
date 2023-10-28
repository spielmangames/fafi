<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\FileSchemas\Entity\Mapper;

use FAFI\src\BE\Domain\Persistence\Player\Player\PlayerResource;
use FAFI\src\BE\ImEx\FileSchemas\Entity\PlayerEntityFileSchema;

class PlayerMapper extends AbstractImExableEntityMapper implements ImExableEntityMapperInterface
{
    private const MAP = [
        PlayerEntityFileSchema::ID => PlayerResource::ID_FIELD,

        PlayerEntityFileSchema::NAME => PlayerResource::NAME_FIELD,
        PlayerEntityFileSchema::PARTICLE => PlayerResource::PARTICLE_FIELD,
        PlayerEntityFileSchema::SURNAME => PlayerResource::SURNAME_FIELD,
        PlayerEntityFileSchema::FAFI_SURNAME => PlayerResource::FAFI_SURNAME_FIELD,

        PlayerEntityFileSchema::HEIGHT => PlayerResource::HEIGHT_FIELD,
        PlayerEntityFileSchema::FOOT => PlayerResource::FOOT_FIELD,
        PlayerEntityFileSchema::IS_FRAGILE => PlayerResource::IS_FRAGILE_FIELD,
    ];

    public function getMap(): array
    {
        return self::MAP;
    }
}
