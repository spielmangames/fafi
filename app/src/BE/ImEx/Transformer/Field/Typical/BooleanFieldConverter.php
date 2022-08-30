<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Field\Typical;

use FAFI\src\BE\ImEx\FileSchemas\Field\BoolFieldFileSchema;
use FAFI\src\BE\ImEx\Transformer\Field\ImportFieldConverter;

class BooleanFieldConverter implements ImportFieldConverter
{
    public function fromStr(string $property, string $value)
    {
        switch ($value) {
            case BoolFieldFileSchema::TRUE:
                $value = true;
                break;
            case BoolFieldFileSchema::FALSE:
                $value = false;
                break;
        }

        return $value;
    }
}
