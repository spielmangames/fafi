<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Schema\Mapper;

use FAFI\src\BE\Domain\Persistence\Player\PlayerAttribute\PlayerAttributeResource;
use FAFI\src\BE\ImEx\Schema\FileSchema\Entity\PlayerAttributeEntityFileSchema;

class PlayerAttributeMapper extends AbstractImExableEntityMapper implements ImExableEntityMapperInterface
{
    private const MAP = [
        PlayerAttributeEntityFileSchema::ID => PlayerAttributeResource::ID_FIELD,

        PlayerAttributeEntityFileSchema::PLAYER => PlayerAttributeResource::PLAYER_ID_FIELD,
        PlayerAttributeEntityFileSchema::POSITION => PlayerAttributeResource::POSITION_ID_FIELD,

        PlayerAttributeEntityFileSchema::ATT_MIN => PlayerAttributeResource::ATT_MIN_FIELD,
        PlayerAttributeEntityFileSchema::ATT_MAX => PlayerAttributeResource::ATT_MAX_FIELD,
        PlayerAttributeEntityFileSchema::DEF_MIN => PlayerAttributeResource::DEF_MIN_FIELD,
        PlayerAttributeEntityFileSchema::DEF_MAX => PlayerAttributeResource::DEF_MAX_FIELD,
    ];

    public function getMap(): array
    {
        return self::MAP;
    }
}
