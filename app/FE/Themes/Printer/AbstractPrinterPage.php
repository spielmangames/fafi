<?php

namespace FAFI\FE\Themes\Printer;

abstract class AbstractPrinterPage
{
    protected function getSectionY(int $yLimit, string $yBorderTop, string $yBorderBottom): int
    {
        return $yLimit - strlen($yBorderTop) - strlen($yBorderBottom);
    }

    protected function getGeneratedLine(int $xLimit, string $value): array
    {
        return array_fill(1, $xLimit, $value);
    }
}
