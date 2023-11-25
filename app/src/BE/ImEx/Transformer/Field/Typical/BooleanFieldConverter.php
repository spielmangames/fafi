<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Field\Typical;

use FAFI\src\BE\ImEx\Schema\FileSchema\Field\BoolFieldFileSchema;
use FAFI\src\BE\ImEx\Transformer\Field\ImportFieldConverter;

class BooleanFieldConverter implements ImportFieldConverter
{
    public function fromStr(string $property, string $value): bool|string
    {
        return match ($value) {
            BoolFieldFileSchema::TRUE => true,
            BoolFieldFileSchema::FALSE => false,

            default => $value,
        };
    }
}
