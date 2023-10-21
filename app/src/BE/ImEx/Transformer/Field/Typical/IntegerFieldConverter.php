<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Field\Typical;

use FAFI\src\BE\ImEx\Transformer\Field\ImportFieldConverter;

class IntegerFieldConverter implements ImportFieldConverter
{
    public function fromStr(string $property, string $value): int|string
    {
        return $this->isInteger($value) ? (int)$value : $value;
    }

    private function isInteger(string $field): bool
    {
        if ($field === '') {
            return false;
        }

        return is_numeric($field) && ctype_digit($field);
    }
}
