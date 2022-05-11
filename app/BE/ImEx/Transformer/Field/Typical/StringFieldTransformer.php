<?php

declare(strict_types=1);

namespace FAFI\BE\ImEx\Transformer\Field\Typical;

use FAFI\BE\ImEx\Transformer\Field\ImExFieldTransformer;

class StringFieldTransformer implements ImExFieldTransformer
{
    public function fromStr(string $property, string $value)
    {
        return $value;
    }
}
