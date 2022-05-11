<?php

namespace FAFI\src\FE\Themes\Printer\Basic\PageSections;

use FAFI\src\FE\Themes\Printer\PrinterDesign as PD;

abstract class AbstractTitle extends AbstractPrinterPageSection
{
    protected int $yReserve = 4;


    public function __construct(int $x)
    {
        parent::__construct($x, $this->yReserve);
    }


    public function getInside(): array
    {
        return [$this->alignCenter($this->prepareTitle(), $this->getX(), PD::PAGE_BASE)];
    }

    abstract protected function prepareTitle(): string;
}
