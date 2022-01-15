<?php

namespace FAFI\FE\Themes\Printer\Basic\PageSections;

class Header extends AbstractPrinterPageSection
{
    protected int $yReserve = 1;
    protected bool $topBorder = false;
    protected bool $topPadding = false;
    protected bool $bottomPadding = false;
    protected bool $bottomBorder = false;


    public function __construct(int $x)
    {
        parent::__construct($x, $this->yReserve);
    }


    public function getInside(): array
    {
        return [];
    }
}
