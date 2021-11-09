<?php

namespace FAFI\FE\Themes\Printer;

trait PrinterHelperTrait
{
    public function alignCenter(string $text, int $width, string $filler): string
    {
        $fill = $width - mb_strlen($text);
        $left = intdiv($fill, 2);
        $right = $fill - $left;

        return str_repeat($filler, $left) . $text . str_repeat($filler, $right);
    }
}
