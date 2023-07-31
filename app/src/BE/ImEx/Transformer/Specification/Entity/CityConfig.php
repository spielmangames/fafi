<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

use FAFI\src\BE\Domain\Dto\Geo\City\City;
use FAFI\src\BE\Domain\Dto\Geo\City\CityConstraints;
use FAFI\src\BE\ImEx\Clients\CountryClient;
use FAFI\src\BE\ImEx\FileSchemas\Entity\CityEntityFileSchema;
use FAFI\src\BE\ImEx\Hydrator\CountryHydrator;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\IntegerFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\StringFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IdSpecification;
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
        ];
    }

    public function getFieldSpecificationsMap(): array
    {
        return [
            CityEntityFileSchema::ID => [ImportableEntityConfig::OBJECT => IdSpecification::class],

            CityEntityFileSchema::NAME => [
                ImportableEntityConfig::OBJECT => StringSpecification::class,
                ImportableEntityConfig::PARAMS => [
                    StringSpecification::PARAM_MIN => CityConstraints::NAME_MIN,
                    StringSpecification::PARAM_MAX => CityConstraints::NAME_MAX
                ]
            ],
        ];
    }

    public function getResourceHydrator(): string
    {
        return CountryHydrator::class;
    }

    public function getSubResourceHydrators(): array
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
