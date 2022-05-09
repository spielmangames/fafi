<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Transformer\Specification\Entity;

use FAFI\src\ImEx\Transformer\Schema\File\CountryFileSchema;

class CountrySpecification implements ImExEntitySpecification
{
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
