<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Field;

interface ExportFieldConverter
{
    public function toStr(string $property, $value): string;
}
