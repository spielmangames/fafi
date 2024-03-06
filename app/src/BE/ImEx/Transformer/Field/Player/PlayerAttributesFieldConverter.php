<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Field\Player;

use FAFI\src\BE\Domain\Persistence\DataValidator;
use FAFI\src\BE\ImEx\Schema\FileSchema\Entity\PlayerAttributeEntityFileSchema;
use FAFI\src\BE\ImEx\Schema\FileSchema\Entity\PlayerAttributeFileSchema;
use FAFI\src\BE\ImEx\Transformer\Field\ImportFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Player\PlayerAttributesSpecification;

class PlayerAttributesFieldConverter implements ImportFieldConverter
{
//    private string $property;


    private DataValidator $dataValidator;

    public function __construct()
    {
        $this->dataValidator = new DataValidator();
    }


    public function fromStr(string $property, string $value): array
    {
//        $this->property = $property;
        return $this->parseAttributeSets($value);
    }

    private function parseAttributeSets(string $attributeSets): array
    {
        $wrappers = PlayerAttributeFileSchema::ATTRIBUTE_WRAP_CLOSE . PlayerAttributeFileSchema::ATTRIBUTE_WRAP_OPEN;
        $attributeSets = trim($attributeSets, $wrappers);
        $attributeSets = explode($wrappers, $attributeSets);

        $converted = [];
        foreach ($attributeSets as $attributeSet) {
            $converted = array_merge($converted, $this->parseAttributeSet($attributeSet));
        }

        return $converted;
    }

    private function parseAttributeSet(string $attributeSet): array
    {
        $attributeSet = explode(PlayerAttributeFileSchema::ATTRIBUTE_NAME_VALUE_SEPARATOR, $attributeSet);
        $position = array_shift($attributeSet);
        $attributes = array_shift($attributeSet);

        $this->dataValidator::assertFieldStr($position);
        $this->dataValidator::assertFieldStr($attributes);
        $attributes = explode(PlayerAttributeFileSchema::ATTRIBUTE_VALUES_SEPARATOR, $attributes);

        return [$position => $this->parseAttributes($attributes)];
    }

    private function parseAttributes(array $attributes): array
    {
        $converted = [];

        foreach ($attributes as $attribute) {
            $converted = array_merge($converted, $this->parseAttribute($attribute));
        }

//        $this->dataValidator::assertFieldArr($attributes, countMin: PlayerAttributeConstraints::PLAYER_POSITIONS_MIN, countMax: PlayerAttributeConstraints::PLAYER_POSITIONS_MAX);
        return $converted;
    }

    private function parseAttribute(string $attribute): array
    {
        $attribute = explode(PlayerAttributeFileSchema::ATTRIBUTE_VALUE_SEPARATOR, $attribute);
        $attributeName = array_shift($attribute);
        $attributeValues = array_shift($attribute);

        $attributeName = $this->convertAttributeName($attributeName);

        $attributeValues = explode(PlayerAttributeFileSchema::ATTRIBUTE_VALUE_RANGE_SEPARATOR, $attributeValues);
        $attributeMin = array_shift($attributeValues);
        $attributeMax = array_shift($attributeValues);

        return [
            $attributeName . '_min' => $attributeMin,
            $attributeName . '_max' => $attributeMax,
        ];
    }

    private function convertAttributeName(string $attributeName): string
    {
        $this->dataValidator::assertFieldOneOf($attributeName, PlayerAttributeFileSchema::ATTRIBUTE_NAME_MAP);
        $map = array_flip(PlayerAttributeFileSchema::ATTRIBUTE_NAME_MAP);

        return $map[$attributeName];
    }

    private function finalValidate(): void
    {
//        $this->dataValidator::assertFieldStr($position, PlayerAttributeEntityFileSchema::POSITION);
    }
}
