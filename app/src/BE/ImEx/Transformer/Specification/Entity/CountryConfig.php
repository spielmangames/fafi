<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

use FAFI\src\BE\Domain\Dto\Geo\Country\Country;
use FAFI\src\BE\ImEx\Clients\CountryClient;
use FAFI\src\BE\ImEx\Hydrator\CountryHydrator;
use FAFI\src\BE\ImEx\FileSchemas\Entity\CountryEntityFileSchema;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\IntegerFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\StringFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IdSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\StringSpecification;

class CountryConfig implements ImportableEntityConfig
{
    public function getEntityName(): string
    {
        return Country::ENTITY;
    }


    public function getFieldConvertersMap(): array
    {
        return [
            CountryEntityFileSchema::ID => IntegerFieldConverter::class,

            CountryEntityFileSchema::NAME => StringFieldConverter::class,
            CountryEntityFileSchema::CONTINENT => StringFieldConverter::class,
        ];
    }

    public function getFieldSpecificationsMap(): array
    {
        return [
            CountryEntityFileSchema::ID => IdSpecification::class,

            CountryEntityFileSchema::NAME => StringSpecification::class,
            CountryEntityFileSchema::CONTINENT => StringSpecification::class,
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
