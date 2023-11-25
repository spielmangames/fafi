<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Schema\Mapper;

use FAFI\src\BE\Domain\Persistence\Player\Position\PositionResource;
use FAFI\src\BE\ImEx\Schema\FileSchema\Entity\PositionEntityFileSchema;

class PositionMapper extends AbstractImExableEntityMapper implements ImExableEntityMapperInterface
{
    private const MAP = [
        PositionEntityFileSchema::ID => PositionResource::ID_FIELD,

        PositionEntityFileSchema::NAME => PositionResource::NAME_FIELD,
    ];

    public function getMap(): array
    {
        return self::MAP;
    }
}
