<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical;

use FAFI\src\BE\Domain\Persistence\DataValidator;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\ImExFieldSpecification;

abstract class OneOfSpecification implements ImExFieldSpecification
{
    public array $allowed;


    private DataValidator $dataValidator;

    public function __construct()
    {
        $this->dataValidator = new DataValidator();
    }


    public function validate(string $property, $value): void
    {
        $this->dataValidator->assertFieldOneOf($value, $property, $this->allowed);
    }
}
