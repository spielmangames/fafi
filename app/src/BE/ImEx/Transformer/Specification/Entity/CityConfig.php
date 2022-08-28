<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

use FAFI\src\BE\ImEx\Persistence\Client\CountryClient;
use FAFI\src\BE\ImEx\Persistence\Hydrator\CountryHydrator;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\IntegerFieldTransformer;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\StringFieldTransformer;
use FAFI\src\BE\ImEx\Transformer\Schema\File\CityFileSchema;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IntegerSpecification;
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
            CityFileSchema::COUNTRY,
        ];
    }

    public function getFieldTransformersMap(): array
    {
        return [
            CityFileSchema::ID => IntegerFieldTransformer::class,

            CityFileSchema::NAME => StringFieldTransformer::class,
            CityFileSchema::REGION => StringFieldTransformer::class,
            CityFileSchema::COUNTRY => IntegerFieldTransformer::class,
        ];
    }

    public function getFieldSpecificationsMap(): array
    {
        return [
            CityFileSchema::ID => IntegerSpecification::class,

            CityFileSchema::NAME => StringSpecification::class,
            CityFileSchema::REGION => StringSpecification::class,
            CityFileSchema::COUNTRY => IntegerSpecification::class,
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
