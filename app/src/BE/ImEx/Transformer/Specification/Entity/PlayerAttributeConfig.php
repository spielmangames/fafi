<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

use FAFI\src\BE\Domain\Dto\Player\PlayerAttribute\PlayerAttribute;
use FAFI\src\BE\Domain\Persistence\Player\PlayerAttribute\PlayerAttributeDataHydrator;
use FAFI\src\BE\ImEx\Clients\PlayerAttributeClient;
use FAFI\src\BE\ImEx\Schema\FileSchema\Entity\PlayerAttributeEntityFileSchema;
use FAFI\src\BE\ImEx\Schema\Mapper\PlayerAttributeMapper;
use FAFI\src\BE\ImEx\Transformer\Field\Player\PositionNameToIdFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\IntegerFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IdSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IntegerSpecification;

class PlayerAttributeConfig implements ImportableEntityConfig
{
    public function getEntityName(): string
    {
        return PlayerAttribute::ENTITY;
    }


    public function getSubResourcesMap(): array
    {
        return [];
    }


    public function getFieldConvertersMap(): array
    {
        return [
            PlayerAttributeEntityFileSchema::ID => IntegerFieldConverter::class,

//            PlayerAttributeEntityFileSchema::PLAYER => PlayerFullNameToIdFieldConverter::class,
            PlayerAttributeEntityFileSchema::POSITION => PositionNameToIdFieldConverter::class,

            PlayerAttributeEntityFileSchema::ATT_MIN => IntegerFieldConverter::class,
            PlayerAttributeEntityFileSchema::ATT_MAX => IntegerFieldConverter::class,
            PlayerAttributeEntityFileSchema::DEF_MIN => IntegerFieldConverter::class,
            PlayerAttributeEntityFileSchema::DEF_MAX => IntegerFieldConverter::class,
        ];
    }

    public function getFieldSpecificationsMap(): array
    {
        return [
            PlayerAttributeEntityFileSchema::ID => IdSpecification::class,

//            PlayerAttributeEntityFileSchema::PLAYER => IdSpecification::class,
            PlayerAttributeEntityFileSchema::POSITION => IdSpecification::class,

            PlayerAttributeEntityFileSchema::ATT_MIN => IntegerSpecification::class,
            PlayerAttributeEntityFileSchema::ATT_MAX => IntegerSpecification::class,
            PlayerAttributeEntityFileSchema::DEF_MIN => IntegerSpecification::class,
            PlayerAttributeEntityFileSchema::DEF_MAX => IntegerSpecification::class,
        ];
    }

    public function getResourceMapper(): string
    {
        return PlayerAttributeMapper::class;
    }

    public function getResourceDataHydrator(): string
    {
        return PlayerAttributeDataHydrator::class;
    }


    public function getResourceLoader(): string
    {
        return PlayerAttributeClient::class;
    }
}
