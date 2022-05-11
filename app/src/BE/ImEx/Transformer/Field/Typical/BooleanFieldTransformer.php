<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Field\Typical;

use FAFI\src\BE\ImEx\Transformer\Field\ImExFieldTransformer;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\BooleanSpecification;

class BooleanFieldTransformer implements ImExFieldTransformer
{
    public function fromStr(string $property, string $value)
    {
        switch ($value) {
            case BooleanSpecification::TRUE_FIELD:
                $value = true;
                break;
            case BooleanSpecification::FALSE_FIELD:
                $value = false;
                break;
        }

        return $value;
    }
}
