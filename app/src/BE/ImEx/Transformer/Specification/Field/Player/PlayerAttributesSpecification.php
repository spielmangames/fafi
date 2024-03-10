<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Field\Player;

use FAFI\src\BE\Domain\Dto\Player\PlayerAttribute\PlayerAttributeConstraints;
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
        $this->dataValidator::assertFieldArr($value, $property, PlayerAttributeConstraints::PLAYER_POSITIONS_MIN, PlayerAttributeConstraints::PLAYER_POSITIONS_MAX);
        foreach ($value as $position => $attribute) {
            $this->validateAttribute($property, $position, $attribute);
        }
    }

    private function validateAttribute(string $property, $position, $attribute): void
    {
        $this->dataValidator::assertFieldStr($position, $property);
        $this->dataValidator::assertFieldArr($attribute, $property);
    }
}
