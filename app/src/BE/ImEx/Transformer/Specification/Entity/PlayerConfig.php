<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

use FAFI\src\BE\Domain\Dto\Player\Player\Player;
use FAFI\src\BE\ImEx\Clients\PlayerAttributeClient;
use FAFI\src\BE\ImEx\Clients\PlayerClient;
use FAFI\src\BE\ImEx\Hydrator\PlayerAttributeHydrator;
use FAFI\src\BE\ImEx\Hydrator\PlayerHydrator;
use FAFI\src\BE\ImEx\FileSchemas\Entity\PlayerEntityFileSchema;
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

            PlayerEntityFileSchema::HEIGHT => IntegerFieldConverter::class,
            PlayerEntityFileSchema::FOOT => StringFieldConverter::class,
            PlayerEntityFileSchema::INJURE_FACTOR => BooleanFieldConverter::class,

            PlayerEntityFileSchema::ATTRIBUTES => PlayerAttributesFieldConverter::class,
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

            PlayerEntityFileSchema::HEIGHT => IntegerSpecification::class,
            PlayerEntityFileSchema::FOOT => StringSpecification::class,
            PlayerEntityFileSchema::INJURE_FACTOR => BooleanSpecification::class,


            PlayerEntityFileSchema::ATTRIBUTES => PlayerAttributesSpecification::class,
        ];
    }

    public function getResourceDataHydrator(): string
    {
        return PlayerHydrator::class;
    }

    public function getSubResourceDataHydrators(): array
    {
        return [
            PlayerEntityFileSchema::ATTRIBUTES => PlayerAttributeHydrator::class,
        ];
    }


    public function getResourceLoader(): string
    {
        return PlayerClient::class;
    }

    public function getSubResourceLoaders(): array
    {
        return [
            PlayerEntityFileSchema::ATTRIBUTES => PlayerAttributeClient::class,
        ];
    }
}
