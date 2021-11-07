<?php

namespace FAFI\FE\Themes\Printer;

use FAFI\FE\PageSectionInterface;
use FAFI\FE\Themes\Printer\PrinterDesign as PD;

class Footer implements PageSectionInterface
{
    private const WATERMARK = 'FAFI  2021';

    public function get(): array
    {
        $xLimit = PD::PAGE_X_SIZE;
        $yLimit = $this->getSectionY(
            PD::FOOTER_Y_SIZE,
            PD::FOOTER_TOP_BORDER,
            PD::FOOTER_TOP_PADDING,
            PD::FOOTER_BOTTOM_PADDING,
            PD::FOOTER_BOTTOM_BORDER
        );

        $before = $this->fillBeforeSection(PD::FOOTER_TOP_BORDER, PD::FOOTER_TOP_PADDING);
        $inside = [$this->alignCenter(self::WATERMARK, $xLimit, PD::PAGE_BASE)];
        $after = $this->fillAfterSection(PD::FOOTER_BOTTOM_PADDING, PD::FOOTER_BOTTOM_BORDER, $yLimit - count($inside));

        return array_merge($before, $inside, $after);
    }
}
