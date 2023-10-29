<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\FileSchemas\Entity\Mapper;

use FAFI\src\BE\Domain\Persistence\Team\Club\ClubResource;
use FAFI\src\BE\ImEx\FileSchemas\Entity\ClubEntityFileSchema;

class ClubMapper extends AbstractImExableEntityMapper implements ImExableEntityMapperInterface
{
    private const MAP = [
        ClubEntityFileSchema::ID => ClubResource::ID_FIELD,

        ClubEntityFileSchema::NAME => ClubResource::NAME_FIELD,
        ClubEntityFileSchema::FAFI_NAME => ClubResource::FAFI_NAME_FIELD,
        ClubEntityFileSchema::CITY => ClubResource::CITY_ID_FIELD,
        ClubEntityFileSchema::FOUNDED => ClubResource::FOUNDED_FIELD,
    ];

    public function getMap(): array
    {
        return self::MAP;
    }
}
