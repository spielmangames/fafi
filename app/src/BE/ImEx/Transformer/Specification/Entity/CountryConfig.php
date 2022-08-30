<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

use FAFI\src\BE\Domain\Dto\Geo\Country\Country;
use FAFI\src\BE\Domain\Dto\Geo\Country\CountryConstraints;
use FAFI\src\BE\ImEx\Clients\CountryClient;
use FAFI\src\BE\ImEx\Hydrator\CountryHydrator;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\IntegerFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\StringFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Schema\File\CountryFileSchema;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\EnumSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IdSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\StringSpecification;

class CountryConfig implements ImportableEntityConfig
{
    public function getEntityName(): string
    {
        return Country::ENTITY;
    }


    public function getMandatoryFieldsOnCreate(): array
    {
        return [
            CountryFileSchema::NAME,
            CountryFileSchema::CONTINENT,
        ];
    }

    public function getFieldConvertersMap(): array
    {
        return [
            CountryFileSchema::ID => IntegerFieldConverter::class,

            CountryFileSchema::NAME => StringFieldConverter::class,
            CountryFileSchema::CONTINENT => StringFieldConverter::class,
        ];
    }

    public function getFieldSpecificationsMap(): array
    {
        return [
            CountryFileSchema::ID => [ImportableEntityConfig::OBJECT => IdSpecification::class],

            CountryFileSchema::NAME => [
                ImportableEntityConfig::OBJECT => StringSpecification::class,
                ImportableEntityConfig::PARAMS => [
                    StringSpecification::PARAM_MIN => CountryConstraints::NAME_MIN,
                    StringSpecification::PARAM_MAX => CountryConstraints::NAME_MAX
                ]
            ],
            CountryFileSchema::CONTINENT => [
                ImportableEntityConfig::OBJECT => EnumSpecification::class,
                ImportableEntityConfig::PARAMS => [
                    EnumSpecification::PARAM_SUPPORTED => CountryConstraints::CONTINENTS_SUPPORTED
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
