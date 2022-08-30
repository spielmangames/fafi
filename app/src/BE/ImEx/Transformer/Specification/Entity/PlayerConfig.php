<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

use FAFI\src\BE\Domain\Dto\Player\Player\Player;
use FAFI\src\BE\ImEx\Clients\PlayerAttributeClient;
use FAFI\src\BE\ImEx\Clients\PlayerClient;
use FAFI\src\BE\ImEx\Hydrator\PlayerAttributeHydrator;
use FAFI\src\BE\ImEx\Hydrator\PlayerHydrator;
use FAFI\src\BE\ImEx\Transformer\Field\Player\PlayerAttributesFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\BooleanFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\IntegerFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\StringFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Schema\File\PlayerFileSchema;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Player\PlayerAttributesSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\BooleanSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\EnumSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IdSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IntegerSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\StringSpecification;

class PlayerConfig implements ImportableEntityConfig
{
    public function getEntityName(): string
    {
        return Player::ENTITY;
    }


    public function getMandatoryFieldsOnCreate(): array
    {
        return [
            PlayerFileSchema::SURNAME,
            PlayerFileSchema::FOOT,

            PlayerFileSchema::ATTRIBUTES,
        ];
    }

    public function getFieldConvertersMap(): array
    {
        return [
            PlayerFileSchema::ID => IntegerFieldConverter::class,

            PlayerFileSchema::NAME => StringFieldConverter::class,
            PlayerFileSchema::PARTICLE => StringFieldConverter::class,
            PlayerFileSchema::SURNAME => StringFieldConverter::class,
            PlayerFileSchema::FAFI_SURNAME => StringFieldConverter::class,

            PlayerFileSchema::HEIGHT => IntegerFieldConverter::class,
            PlayerFileSchema::FOOT => StringFieldConverter::class,
            PlayerFileSchema::INJURE_FACTOR => BooleanFieldConverter::class,

            PlayerFileSchema::ATTRIBUTES => PlayerAttributesFieldConverter::class,
        ];
    }

    public function getFieldSpecificationsMap(): array
    {
        return [
            PlayerFileSchema::ID => [ImportableEntityConfig::OBJECT => IdSpecification::class],

            PlayerFileSchema::NAME => [
                ImportableEntityConfig::OBJECT => StringSpecification::class,
                ImportableEntityConfig::PARAMS => []
            ],
            PlayerFileSchema::PARTICLE => [
                ImportableEntityConfig::OBJECT => StringSpecification::class,
                ImportableEntityConfig::PARAMS => []
            ],
            PlayerFileSchema::SURNAME => [
                ImportableEntityConfig::OBJECT => StringSpecification::class,
                ImportableEntityConfig::PARAMS => []
            ],
            PlayerFileSchema::FAFI_SURNAME => [
                ImportableEntityConfig::OBJECT => StringSpecification::class,
                ImportableEntityConfig::PARAMS => []
            ],

            PlayerFileSchema::HEIGHT => [
                ImportableEntityConfig::OBJECT => IntegerSpecification::class,
                ImportableEntityConfig::PARAMS => []
            ],
            PlayerFileSchema::FOOT => [
                ImportableEntityConfig::OBJECT => EnumSpecification::class,
                ImportableEntityConfig::PARAMS => []
            ],
            PlayerFileSchema::INJURE_FACTOR => [
                ImportableEntityConfig::OBJECT => BooleanSpecification::class,
                ImportableEntityConfig::PARAMS => []
            ],


            PlayerFileSchema::ATTRIBUTES => [
                ImportableEntityConfig::OBJECT => PlayerAttributesSpecification::class,
                ImportableEntityConfig::PARAMS => []
            ],
        ];
    }

    public function getResourceHydrator(): string
    {
        return PlayerHydrator::class;
    }

    public function getSubResourceHydrators(): array
    {
        return [
            PlayerFileSchema::ATTRIBUTES => PlayerAttributeHydrator::class,
        ];
    }


    public function getResourceLoader(): string
    {
        return PlayerClient::class;
    }

    public function getSubResourceLoaders(): array
    {
        return [
            PlayerFileSchema::ATTRIBUTES => PlayerAttributeClient::class,
        ];
    }
}
