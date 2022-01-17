<?php

namespace FAFI\FE\Themes\Printer\Basic\PageSections;

use FAFI\FE\Themes\Printer\PrinterDesign as PD;

abstract class AbstractTitle extends AbstractPrinterPageSection
{
    public function __construct(int $x)
    {
        parent::__construct($x, $this->yReserve);
    }


    public function getInside(): array
    {
        return [$this->alignCenter($this->prepareContent(), $this->getX(), PD::PAGE_BASE)];
    }

    abstract protected function prepareContent(): string;
}
