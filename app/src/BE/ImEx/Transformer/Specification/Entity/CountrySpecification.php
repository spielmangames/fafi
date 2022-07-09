<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

use FAFI\src\BE\ImEx\Persistence\Client\CountryClient;
use FAFI\src\BE\ImEx\Persistence\Hydrator\CountryHydrator;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\IntegerFieldTransformer;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\StringFieldTransformer;
use FAFI\src\BE\ImEx\Transformer\Schema\File\CountryFileSchema;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Country\CountryContinentSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IntegerSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\StringSpecification;

class CountrySpecification implements ImExEntitySpecification
{
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
            CountryFileSchema::ID => IntegerSpecification::class,

            CountryFileSchema::NAME => StringSpecification::class,
            CountryFileSchema::CONTINENT => CountryContinentSpecification::class,
        ];
    }

    public function getMandatoryFieldsOnCreate(): array
    {
        return [
            CountryFileSchema::NAME,
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
