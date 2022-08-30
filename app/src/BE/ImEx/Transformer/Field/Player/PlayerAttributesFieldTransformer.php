<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Field\Player;

use FAFI\src\BE\ImEx\Transformer\Field\ImportFieldTransformer;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Player\PlayerAttributesSpecification;

class PlayerAttributesFieldTransformer implements ImportFieldTransformer
{
    public function fromStr(string $property, string $value)
    {
        $attributeSets = explode(PlayerAttributesSpecification::ATTRIBUTES_SEPARATOR, $value);

        $transformed = [];
        foreach ($attributeSets as $attributeSet) {
            $transformed = array_merge($transformed, $this->parseAttributeSet($attributeSet));
        }

        return $transformed;
    }

    private function parseAttributeSet(string $attributeSet): array
    {
        $attributeSet = explode(PlayerAttributesSpecification::ATTRIBUTE_NAME_VALUE_SEPARATOR, $attributeSet);
        $position = array_shift($attributeSet);
        $attributes = array_shift($attributeSet);

        $attributes = explode(PlayerAttributesSpecification::ATTRIBUTE_VALUES_SEPARATOR, $attributes);

        $transformed = [];
        foreach ($attributes as $attribute) {
            $transformed = array_merge($transformed, $this->parseAttribute($attribute));
        }

        return [$position => $transformed];
    }

    private function parseAttribute(string $attribute): array
    {
        $attribute = explode(PlayerAttributesSpecification::ATTRIBUTE_VALUE_SEPARATOR, $attribute);
        $attributeName = array_shift($attribute);
        $attributeValues = array_shift($attribute);

        $attributeValues = explode(PlayerAttributesSpecification::ATTRIBUTE_VALUE_RANGE_SEPARATOR, $attributeValues);
        $valueMin = array_shift($attributeValues);
        $valueMax = !empty($attributeValues) ? array_shift($attributeValues) : $valueMin;

        return [
            $attributeName . '_min' => $valueMin,
            $attributeName . '_max' => $valueMax,
        ];
    }
}
