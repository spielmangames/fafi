<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

use FAFI\src\BE\Domain\Dto\Geo\Country\Country;
use FAFI\src\BE\ImEx\Persistence\Client\CountryClient;
use FAFI\src\BE\ImEx\Persistence\Hydrator\CountryHydrator;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\IntegerFieldTransformer;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\StringFieldTransformer;
use FAFI\src\BE\ImEx\Transformer\Schema\File\CountryFileSchema;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IdSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\OneOfSpecification;
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

    public function getFieldTransformersMap(): array
    {
        return [
            CountryFileSchema::ID => IntegerFieldTransformer::class,

            CountryFileSchema::NAME => StringFieldTransformer::class,
            CountryFileSchema::CONTINENT => StringFieldTransformer::class,
        ];
    }

    public function getFieldSpecificationsMap(): array
    {
        return [
            CountryFileSchema::ID => [ImportableEntityConfig::OBJECT => IdSpecification::class],

            CountryFileSchema::NAME => [
                ImportableEntityConfig::OBJECT => StringSpecification::class,
                ImportableEntityConfig::PARAMS => []
            ],
            CountryFileSchema::CONTINENT => [
                ImportableEntityConfig::OBJECT => OneOfSpecification::class,
                ImportableEntityConfig::PARAMS => [Country::CONTINENTS_SUPPORTED]
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