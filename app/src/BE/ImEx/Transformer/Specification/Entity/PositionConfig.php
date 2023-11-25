<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

use FAFI\src\BE\Domain\Dto\Player\Position\Position;
use FAFI\src\BE\Domain\Persistence\Player\Position\PositionDataHydrator;
use FAFI\src\BE\ImEx\Clients\PositionClient;
use FAFI\src\BE\ImEx\Schema\FileSchema\Entity\PositionEntityFileSchema;
use FAFI\src\BE\ImEx\Schema\Mapper\PositionMapper;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\IntegerFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\StringFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IdSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\StringSpecification;

class PositionConfig implements ImportableEntityConfig
{
    public function getEntityName(): string
    {
        return Position::ENTITY;
    }


    public function getFieldConvertersMap(): array
    {
        return [
            PositionEntityFileSchema::ID => IntegerFieldConverter::class,

            PositionEntityFileSchema::NAME => StringFieldConverter::class,
        ];
    }

    public function getFieldSpecificationsMap(): array
    {
        return [
            PositionEntityFileSchema::ID => IdSpecification::class,

            PositionEntityFileSchema::NAME => StringSpecification::class,
        ];
    }

    public function getResourceMapper(): string
    {
        return PositionMapper::class;
    }

    public function getResourceDataHydrator(): string
    {
        return PositionDataHydrator::class;
    }


    public function getResourceLoader(): string
    {
        return PositionClient::class;
    }
}
