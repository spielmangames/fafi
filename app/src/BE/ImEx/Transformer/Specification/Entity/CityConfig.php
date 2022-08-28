<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

use FAFI\src\BE\ImEx\Persistence\Client\CountryClient;
use FAFI\src\BE\ImEx\Persistence\Hydrator\CountryHydrator;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\IntegerFieldTransformer;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\StringFieldTransformer;
use FAFI\src\BE\ImEx\Transformer\Schema\File\CityFileSchema;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IdSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\StringSpecification;

class CityConfig implements ImportableEntityConfig
{
    public function getEntityName(): string
    {
        return City::ENTITY;
    }


    public function getMandatoryFieldsOnCreate(): array
    {
        return [
            CityFileSchema::NAME,
        ];
    }

    public function getFieldTransformersMap(): array
    {
        return [
            CityFileSchema::ID => IntegerFieldTransformer::class,

            CityFileSchema::NAME => StringFieldTransformer::class,
        ];
    }

    public function getFieldSpecificationsMap(): array
    {
        return [
            CityFileSchema::ID => [ImportableEntityConfig::OBJECT => IdSpecification::class],

            CityFileSchema::NAME => [
                ImportableEntityConfig::OBJECT => StringSpecification::class,
                ImportableEntityConfig::PARAMS => []
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
