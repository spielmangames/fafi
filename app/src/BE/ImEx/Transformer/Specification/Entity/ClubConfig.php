<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

use FAFI\src\BE\Domain\Dto\Team\Club\Club;
use FAFI\src\BE\Domain\Persistence\Team\Club\ClubDataHydrator;
use FAFI\src\BE\ImEx\Clients\ClubClient;
use FAFI\src\BE\ImEx\Schema\FileSchema\Entity\ClubEntityFileSchema;
use FAFI\src\BE\ImEx\Schema\Mapper\ClubMapper;
use FAFI\src\BE\ImEx\Transformer\Field\Geo\CityNameToIdFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\IntegerFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\StringFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IdSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IntegerSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\StringSpecification;

class ClubConfig implements ImportableEntityConfig
{
    public function getEntityName(): string
    {
        return Club::ENTITY;
    }


    public function getFieldConvertersMap(): array
    {
        return [
            ClubEntityFileSchema::ID => IntegerFieldConverter::class,

            ClubEntityFileSchema::NAME => StringFieldConverter::class,
            ClubEntityFileSchema::FAFI_NAME => StringFieldConverter::class,
            ClubEntityFileSchema::CITY => CityNameToIdFieldConverter::class,
            ClubEntityFileSchema::FOUNDED => IntegerFieldConverter::class,
        ];
    }

    public function getFieldSpecificationsMap(): array
    {
        return [
            ClubEntityFileSchema::ID => IdSpecification::class,

            ClubEntityFileSchema::NAME => StringSpecification::class,
            ClubEntityFileSchema::FAFI_NAME => StringSpecification::class,
            ClubEntityFileSchema::CITY => IdSpecification::class,
            ClubEntityFileSchema::FOUNDED => IntegerSpecification::class,
        ];
    }

    public function getResourceMapper(): string
    {
        return ClubMapper::class;
    }

    public function getResourceDataHydrator(): string
    {
        return ClubDataHydrator::class;
    }


    public function getResourceLoader(): string
    {
        return ClubClient::class;
    }
}
