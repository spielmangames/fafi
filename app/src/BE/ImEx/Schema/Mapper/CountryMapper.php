<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Schema\Mapper;

use FAFI\src\BE\Domain\Persistence\Geo\Country\CountryResource;
use FAFI\src\BE\ImEx\FileSchemas\Entity\Mapper\ImExableEntityMapperInterface;
use FAFI\src\BE\ImEx\Schema\FileSchema\Entity\CountryEntityFileSchema;

class CountryMapper extends AbstractImExableEntityMapper implements ImExableEntityMapperInterface
{
    private const MAP = [
        CountryEntityFileSchema::ID => CountryResource::ID_FIELD,

        CountryEntityFileSchema::NAME => CountryResource::NAME_FIELD,
        CountryEntityFileSchema::CONTINENT => CountryResource::CONTINENT_FIELD,
    ];

    public function getMap(): array
    {
        return self::MAP;
    }
}
