<?php

namespace FAFI\FE\Themes\Printer;

use FAFI\FE\PageSectionInterface;
use FAFI\FE\Themes\Printer\PageSections\AbstractPrinterPageSection;
use FAFI\FE\Themes\Printer\PrinterDesign as PD;

class Footer extends AbstractPrinterPageSection implements PageSectionInterface
{
    private const WATERMARK = 'FAFI  2021';


    protected int $yReserve = 2;
    protected bool $topBorder = false;
    protected bool $topPadding = true;
    protected bool $bottomPadding = false;
    protected bool $bottomBorder = false;


    public function __construct(int $x)
    {
        parent::__construct($x);
    }


    public function get(): array
    {
        $before = $this->fillBefore($this->topBorder, $this->topPadding);
        $inside = [$this->alignCenter(self::WATERMARK, $this->getX(), PD::PAGE_BASE)];
        $after = $this->fillAfter($this->bottomPadding, $this->bottomBorder, $this->getY() - count($inside));

        return array_merge($before, $inside, $after);
    }
}
