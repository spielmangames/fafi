<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Field\Player;

use FAFI\src\BE\Domain\Persistence\DataValidator;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\FieldSpecification;

class PlayerAttributesSpecification implements FieldSpecification
{
    public const ATTRIBUTE_WRAP_OPEN = '[';
    public const ATTRIBUTE_WRAP_CLOSE = ']';
    public const ATTRIBUTE_NAME_VALUE_SEPARATOR = ':';
    public const ATTRIBUTE_VALUES_SEPARATOR = ';';
    public const ATTRIBUTE_VALUE_SEPARATOR = '=';
    public const ATTRIBUTE_VALUE_RANGE_SEPARATOR = '.';

    public const ATTRIBUTE_NAME_ATT = 'a';
    public const ATTRIBUTE_NAME_DEF = 'd';


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
