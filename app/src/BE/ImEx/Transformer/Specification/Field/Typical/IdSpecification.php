<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical;

use FAFI\src\BE\ImEx\Transformer\Specification\Field\AbstractFieldSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\FieldSpecification;

class IdSpecification extends AbstractFieldSpecification implements FieldSpecification
{
    public function validate(string $property, $value): void
    {
        $this->dataValidator::assertFieldInt($value, $property, 1);
    }
}
