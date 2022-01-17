<?php

namespace FAFI\FE\Themes\Printer\Basic\PageSections;

abstract class AbstractWidget extends AbstractPrinterPageSection
{
    public function __construct(int $x, int $yReserve)
    {
        parent::__construct($x, $yReserve);
    }


    abstract public function getInside(): array;

    abstract protected function prepareContent(): string;
}
