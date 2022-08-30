<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

use FAFI\src\BE\Domain\Dto\Player\Position\Position;
use FAFI\src\BE\ImEx\Clients\PositionClient;
use FAFI\src\BE\ImEx\Hydrator\PositionHydrator;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\IntegerFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\StringFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Schema\File\PositionFileSchema;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IdSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\StringSpecification;

class PositionConfig implements ImportableEntityConfig
{
    public function getEntityName(): string
    {
        return Position::ENTITY;
    }


    public function getMandatoryFieldsOnCreate(): array
    {
        return [
            PositionFileSchema::NAME,
        ];
    }

    public function getFieldConvertersMap(): array
    {
        return [
            PositionFileSchema::ID => IntegerFieldConverter::class,

            PositionFileSchema::NAME => StringFieldConverter::class,
        ];
    }

    public function getFieldSpecificationsMap(): array
    {
        return [
            PositionFileSchema::ID => [ImportableEntityConfig::OBJECT => IdSpecification::class],

            PositionFileSchema::NAME => [
                ImportableEntityConfig::OBJECT => StringSpecification::class,
                ImportableEntityConfig::PARAMS => []
            ],
        ];
    }

    public function getResourceHydrator(): string
    {
        return PositionHydrator::class;
    }

    public function getSubResourceHydrators(): array
    {
        return [];
    }


    public function getResourceLoader(): string
    {
        return PositionClient::class;
    }

    public function getSubResourceLoaders(): array
    {
        return [];
    }
}
