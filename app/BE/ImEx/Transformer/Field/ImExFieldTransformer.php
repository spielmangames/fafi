<?php

declare(strict_types=1);

namespace FAFI\BE\ImEx\Transformer\Field;

interface ImExFieldTransformer
{
    public function fromStr(string $property, string $value);
//    public function toStr(string $property, $value): string;
}
