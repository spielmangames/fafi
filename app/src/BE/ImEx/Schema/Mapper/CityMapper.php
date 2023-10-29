<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\FileSchemas\Entity\Mapper;

use FAFI\src\BE\Domain\Persistence\Geo\City\CityResource;
use FAFI\src\BE\ImEx\FileSchemas\Entity\CityEntityFileSchema;

class CityMapper extends AbstractImExableEntityMapper implements ImExableEntityMapperInterface
{
    private const MAP = [
        CityEntityFileSchema::ID => CityResource::ID_FIELD,

        CityEntityFileSchema::NAME => CityResource::NAME_FIELD,
        CityEntityFileSchema::COUNTRY => CityResource::COUNTRY_ID_FIELD,
    ];

    public function getMap(): array
    {
        return self::MAP;
    }
}
