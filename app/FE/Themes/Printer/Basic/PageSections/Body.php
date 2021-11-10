<?php

namespace FAFI\FE\Themes\Printer\Basic\PageSections;

use FAFI\FE\PageSectionInterface;

class Body extends AbstractPrinterPageSection implements PageSectionInterface
{
    protected bool $topBorder = false;
    protected bool $topPadding = false;
    protected bool $bottomPadding = false;
    protected bool $bottomBorder = false;


    public function __construct(int $x)
    {
        parent::__construct($x);
    }

    public function setYReserve(int $yReserve): self
    {
        $this->yReserve = $yReserve;
        return $this;
    }

    public function getInside(): array
    {
        return [];
    }
}
