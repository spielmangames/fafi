<?php

namespace FAFI\FE\Themes\Printer\Basic\Sections;

use FAFI\FE\PageSectionInterface;
use FAFI\FE\Themes\Printer\PageSections\AbstractPrinterPageSection;
use FAFI\FE\Themes\Printer\PrinterDesign as PD;

class Title extends AbstractPrinterPageSection implements PageSectionInterface
{
    protected int $yReserve = 4;
    protected bool $topBorder = true;
    protected bool $topPadding = true;
    protected bool $bottomPadding = true;
    protected bool $bottomBorder = false;


//    public function __construct(int $x)
//    {
//        parent::__construct($x);
//    }


    public function get(): array
    {
        $before = $this->fillBefore($this->topBorder, $this->topPadding);
        $inside = [$this->alignCenter($this->prepareContent(), $this->getX(), PD::PAGE_BASE)];
        $after = $this->fillAfter($this->bottomPadding, $this->bottomBorder, $this->getY() - count($inside));

        return array_merge($before, $inside, $after);
    }

    protected function prepareContent(): string
    {
        return '';
    }
}
