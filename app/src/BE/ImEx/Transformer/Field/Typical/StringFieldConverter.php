<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Field\Typical;

use FAFI\src\BE\ImEx\Transformer\Field\ImportFieldConverter;

class StringFieldConverter implements ImportFieldConverter
{
    public function fromStr(string $property, string $value)
    {
        return $value;
    }
}
