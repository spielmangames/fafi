<?php

namespace FAFI\FE\Themes\Printer;

use FAFI\FE\PageSectionInterface;
use FAFI\FE\Themes\Printer\PrinterDesign as PD;

class Header implements PageSectionInterface
{
    public function get(): array
    {
        $xLimit = PD::PAGE_X_SIZE;
        $yLimit = $this->getSectionY(
            PD::HEADER_Y_SIZE,
            PD::HEADER_TOP_BORDER,
            PD::HEADER_TOP_PADDING,
            PD::HEADER_BOTTOM_PADDING,
            PD::HEADER_BOTTOM_BORDER
        );

        $before = $this->fillBeforeSection(PD::HEADER_TOP_BORDER, PD::HEADER_TOP_PADDING);
        $inside = [];
        $after = $this->fillAfterSection(PD::HEADER_BOTTOM_PADDING, PD::HEADER_BOTTOM_BORDER, $yLimit - count($inside));

        return array_merge($before, $inside, $after);
    }
}
