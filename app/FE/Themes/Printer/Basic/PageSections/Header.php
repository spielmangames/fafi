<?php

namespace FAFI\FE\Themes\Printer\Basic\PageSections;

use FAFI\FE\PageSectionInterface;

class Header extends AbstractPrinterPageSection implements PageSectionInterface
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


    public function get(): array
    {
        $before = $this->fillBefore($this->topBorder, $this->topPadding);
        $inside = [];
        $after = $this->fillAfter($this->bottomPadding, $this->bottomBorder, $this->getY() - count($inside));

        return array_merge($before, $inside, $after);
    }
}
