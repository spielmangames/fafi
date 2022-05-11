<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

use FAFI\src\BE\ImEx\Transformer\Field\Typical\IntegerFieldTransformer;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\StringFieldTransformer;
use FAFI\src\BE\ImEx\Transformer\Schema\File\CountryFileSchema;

class CountrySpecification implements ImExEntitySpecification
{
    public function getFieldTransformersMap(): array
    {
        return [
            CountryFileSchema::ID => IntegerFieldTransformer::class,

            CountryFileSchema::NAME => StringFieldTransformer::class,
        ];
    }

    public function getFieldSpecificationsMap(): array
    {
        return [
            CountryFileSchema::NAME,
        ];
    }

    public function getMandatoryFieldsOnCreate(): array
    {
        return [
            CountryFileSchema::NAME,
        ];
    }
}
