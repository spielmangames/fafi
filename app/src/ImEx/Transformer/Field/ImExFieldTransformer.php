<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Transformer\Field;

interface ImExFieldTransformer
{
    public function fromStr(string $property, string $value);
}
