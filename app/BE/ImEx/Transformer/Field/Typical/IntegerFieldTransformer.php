<?php

declare(strict_types=1);

namespace FAFI\BE\ImEx\Transformer\Field\Typical;

use FAFI\BE\ImEx\Transformer\Field\ImExFieldTransformer;

class IntegerFieldTransformer implements ImExFieldTransformer
{
    public function fromStr(string $property, string $value)
    {
        return ctype_digit($value) ? (int)$value : $value;
    }
}
