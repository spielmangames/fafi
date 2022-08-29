<?php

declare(strict_types=1);

namespace FAFI\src\FE\Structure;

interface PrintableInterface
{
    public function forPrint(): string;
}
