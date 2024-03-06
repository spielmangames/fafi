<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Field\Player;

use FAFI\src\BE\Domain\Persistence\DataValidator;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\FieldSpecification;

class PlayerAttributesSpecification implements FieldSpecification
{
    private DataValidator $dataValidator;

    public function __construct()
    {
        $this->dataValidator = new DataValidator();
    }


    public function validate(string $property, $value): void
    {
        $this->dataValidator::assertFieldArr($value, $property);
        foreach ($value as $position => $attribute) {
            $this->validateAttribute($property, $position, $attribute);
        }
    }

    private function validateAttribute(string $property, $attribute): void
    {

    }
}
