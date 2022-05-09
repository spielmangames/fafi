<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Transformer\Specification\Entity;

use FAFI\src\ImEx\Transformer\Schema\CountryFileSchema;

class CountrySpecification implements ImExEntitySpecification
{
    public function getFieldSpecifications(): array
    {
        return [
            CountryFileSchema::NAME,
        ];
    }

//    public function getFieldTransformers(): array
//    {
//        return [];
//    }

    public function getMandatoryFieldsOnCreate(): array
    {
        return [
            CountryFileSchema::NAME,
        ];
    }
}
