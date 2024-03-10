<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Field\Player;

use FAFI\src\BE\Domain\Persistence\DataValidator;
use FAFI\src\BE\ImEx\Schema\FileSchema\Entity\PlayerAttributeEntityFileSchema;
use FAFI\src\BE\ImEx\Schema\FileSchema\Entity\PlayerAttributeFileSchema;
use FAFI\src\BE\ImEx\Transformer\Field\ImportFieldConverter;

class PlayerAttributesFieldConverter implements ImportFieldConverter
{
    private DataValidator $dataValidator;

    public function __construct()
    {
        $this->dataValidator = new DataValidator();
    }


    public function fromStr(string $property, string $value): array
    {
        return $this->parseAttributeSets($value);
    }

    private function parseAttributeSets(string $attributeSets): array
    {
        $wrappers = PlayerAttributeFileSchema::ATTRIBUTE_WRAP_CLOSE . PlayerAttributeFileSchema::ATTRIBUTE_WRAP_OPEN;
        $attributeSets = trim($attributeSets, $wrappers);
        $attributeSets = explode($wrappers, $attributeSets);

        $converted = [];
        foreach ($attributeSets as $attributeSet) {
            $attributeSetConverted = $this->parseAttributeSet($attributeSet);
            $this->validateAttributeSet($attributeSetConverted);
            $converted[] = $attributeSetConverted;
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

        $position = [PlayerAttributeEntityFileSchema::POSITION => $position];
        $attributes = explode(PlayerAttributeFileSchema::ATTRIBUTE_VALUES_SEPARATOR, $attributes);

        return array_merge($position, $this->parseAttributes($attributes));
    }

    private function parseAttributes(array $attributes): array
    {
        $converted = [];

        foreach ($attributes as $attribute) {
            $converted = array_merge($converted, $this->parseAttribute($attribute));
        }

        return $converted;
    }

    private function parseAttribute(string $attribute): array
    {
        $attribute = explode(PlayerAttributeFileSchema::ATTRIBUTE_VALUE_SEPARATOR, $attribute);
        $attributeName = array_shift($attribute);
        $attributeValues = array_shift($attribute);

        $this->dataValidator::assertFieldStr($attributeName);
        $this->dataValidator::assertFieldStr($attributeValues);

        $attributeValues = explode(PlayerAttributeFileSchema::ATTRIBUTE_VALUE_RANGE_SEPARATOR, $attributeValues);
        $attributeMin = array_shift($attributeValues);
        $attributeMax = array_shift($attributeValues);

        $this->dataValidator::assertFieldStr($attributeMin);
        $this->dataValidator::assertFieldStr($attributeMax);

        return [
            $attributeName . '_min' => $attributeMin,
            $attributeName . '_max' => $attributeMax,
        ];
    }

    private function validateAttributeSet(array $attributeSet): void
    {
        foreach ($attributeSet as $field => $value) {
            $this->dataValidator::assertFieldOneOf($field, PlayerAttributeEntityFileSchema::HEADER);
            $this->dataValidator::assertFieldStr($value);
        }
    }
}
