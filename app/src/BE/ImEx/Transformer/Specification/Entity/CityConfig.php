<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

use FAFI\src\BE\Domain\Dto\Geo\City\City;
use FAFI\src\BE\ImEx\Clients\CountryClient;
use FAFI\src\BE\ImEx\FileSchemas\Entity\CityEntityFileSchema;
use FAFI\src\BE\ImEx\Hydrator\CountryHydrator;
use FAFI\src\BE\ImEx\Transformer\Field\Geo\CountryNameToIdFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\IntegerFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\StringFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IdSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IntegerSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\StringSpecification;

class CityConfig implements ImportableEntityConfig
{
    public function getEntityName(): string
    {
        return City::ENTITY;
    }


    public function getFieldConvertersMap(): array
    {
        return [
            CityEntityFileSchema::ID => IntegerFieldConverter::class,

            CityEntityFileSchema::NAME => StringFieldConverter::class,
            CityEntityFileSchema::COUNTRY => CountryNameToIdFieldConverter::class,
        ];
    }

    public function getFieldSpecificationsMap(): array
    {
        return [
            CityEntityFileSchema::ID => IdSpecification::class,

            CityEntityFileSchema::NAME => StringSpecification::class,
            CityEntityFileSchema::COUNTRY => IntegerSpecification::class,
        ];
    }

    public function getResourceDataHydrator(): string
    {
        return CountryHydrator::class;
    }

    public function getSubResourceDataHydrators(): array
    {
        return [];
    }


    public function getResourceLoader(): string
    {
        return CountryClient::class;
    }

    public function getSubResourceLoaders(): array
    {
        return [];
    }
}
