<?php

namespace FAFI\FE\Themes\Printer\Basic\PageSections;

use FAFI\FE\Structure\PageSection\HeaderInterface;

class Header extends AbstractPrinterPageSection implements HeaderInterface
{
    protected int $yReserve = 1;
    protected bool $topBorder = false;
    protected bool $topPadding = false;
    protected bool $bottomPadding = false;
    protected bool $bottomBorder = false;


    public function __construct(int $x)
    {
        parent::__construct($x);
    }


    public function getInside(): array
    {
        return [];
    }
}
