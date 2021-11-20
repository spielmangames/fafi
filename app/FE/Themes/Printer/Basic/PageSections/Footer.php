<?php

namespace FAFI\FE\Themes\Printer\Basic\PageSections;

use FAFI\FE\Structure\PageSection\FooterInterface;
use FAFI\FE\Themes\Printer\PrinterDesign as PD;

class Footer extends AbstractPrinterPageSection implements FooterInterface
{
    private const WATERMARK = 'FAFI  2021';


    protected int $yReserve = 2;
    protected bool $topBorder = false;
    protected bool $topPadding = true;
    protected bool $bottomPadding = false;
    protected bool $bottomBorder = false;


    public function __construct(int $x)
    {
        parent::__construct($x, $this->yReserve);
    }


    public function getInside(): array
    {
        return [$this->alignCenter(self::WATERMARK, $this->getX(), PD::PAGE_BASE)];
    }
}
