<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Field;

interface ImportFieldTransformer
{
    public function fromStr(string $property, string $value);
}
