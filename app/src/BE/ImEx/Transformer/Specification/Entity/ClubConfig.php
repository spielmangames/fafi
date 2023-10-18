<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

use FAFI\src\BE\Domain\Dto\Team\Club\Club;
use FAFI\src\BE\Domain\Persistence\Team\Club\ClubHydrator;
use FAFI\src\BE\ImEx\Clients\ClubClient;
use FAFI\src\BE\ImEx\FileSchemas\Entity\ClubEntityFileSchema;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\IntegerFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\StringFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IdSpecification;
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
        ];
    }

    public function getFieldSpecificationsMap(): array
    {
        return [
            ClubEntityFileSchema::ID => IdSpecification::class,

            ClubEntityFileSchema::NAME => StringSpecification::class,
        ];
    }

    public function getResourceDataHydrator(): string
    {
        return ClubHydrator::class;
    }

    public function getSubResourceDataHydrators(): array
    {
        return [];
    }


    public function getResourceLoader(): string
    {
        return ClubClient::class;
    }

    public function getSubResourceLoaders(): array
    {
        return [];
    }
}
