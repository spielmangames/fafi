<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

use FAFI\src\BE\Domain\Dto\Player\Player\Player;
use FAFI\src\BE\Domain\Persistence\Player\Player\PlayerDataHydrator;
use FAFI\src\BE\ImEx\Clients\PlayerClient;
use FAFI\src\BE\ImEx\Schema\FileSchema\Entity\PlayerEntityFileSchema;
use FAFI\src\BE\ImEx\Schema\Mapper\PlayerMapper;
use FAFI\src\BE\ImEx\Transformer\Field\Geo\CountryNameToIdFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Player\PlayerAttributesFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\BooleanFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\IntegerFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\StringFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Player\PlayerAttributesSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\BooleanSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IdSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IntegerSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\StringSpecification;

class PlayerConfig implements ImportableEntityConfig
{
    public function getEntityName(): string
    {
        return Player::ENTITY;
    }


    public function getFieldConvertersMap(): array
    {
        return [
            PlayerEntityFileSchema::ID => IntegerFieldConverter::class,

            PlayerEntityFileSchema::NAME => StringFieldConverter::class,
            PlayerEntityFileSchema::PARTICLE => StringFieldConverter::class,
            PlayerEntityFileSchema::SURNAME => StringFieldConverter::class,
            PlayerEntityFileSchema::FAFI_SURNAME => StringFieldConverter::class,

            PlayerEntityFileSchema::NATIONALITY => CountryNameToIdFieldConverter::class,

            PlayerEntityFileSchema::HEIGHT => IntegerFieldConverter::class,
            PlayerEntityFileSchema::FOOT => StringFieldConverter::class,
            PlayerEntityFileSchema::IS_FRAGILE => BooleanFieldConverter::class,

            PlayerEntityFileSchema::ATTRIBUTES => PlayerAttributesFieldConverter::class,

            PlayerEntityFileSchema::TMARKT => StringFieldConverter::class,
        ];
    }

    public function getFieldSpecificationsMap(): array
    {
        return [
            PlayerEntityFileSchema::ID => IdSpecification::class,

            PlayerEntityFileSchema::NAME => StringSpecification::class,
            PlayerEntityFileSchema::PARTICLE => StringSpecification::class,
            PlayerEntityFileSchema::SURNAME => StringSpecification::class,
            PlayerEntityFileSchema::FAFI_SURNAME => StringSpecification::class,

            PlayerEntityFileSchema::NATIONALITY => IdSpecification::class,

            PlayerEntityFileSchema::HEIGHT => IntegerSpecification::class,
            PlayerEntityFileSchema::FOOT => StringSpecification::class,
            PlayerEntityFileSchema::IS_FRAGILE => BooleanSpecification::class,

            PlayerEntityFileSchema::ATTRIBUTES => PlayerAttributesSpecification::class,

            PlayerEntityFileSchema::TMARKT => StringSpecification::class,
        ];
    }

    public function getResourceMapper(): string
    {
        return PlayerMapper::class;
    }

    public function getResourceDataHydrator(): string
    {
        return PlayerDataHydrator::class;
    }


    public function getResourceLoader(): string
    {
        return PlayerClient::class;
    }
}
