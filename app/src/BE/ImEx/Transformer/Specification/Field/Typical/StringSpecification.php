<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical;

use FAFI\src\BE\ImEx\Transformer\Specification\Field\ImExFieldSpecification;
use FAFI\src\BE\Structure\Repository\DataValidator;

class StringSpecification implements ImExFieldSpecification
{
    private DataValidator $dataValidator;

    public function __construct()
    {
        $this->dataValidator = new DataValidator();
    }


    public function validate(string $property, $value): void
    {
        $this->dataValidator->assertFieldStr($value, $property);
    }
}
