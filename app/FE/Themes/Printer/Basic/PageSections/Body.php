<?php

namespace FAFI\FE\Themes\Printer\Basic\PageSections;

use FAFI\FE\Structure\PageSection\BodyInterface;

class Body extends AbstractPrinterPageSection implements BodyInterface
{
    protected bool $topBorder = false;
    protected bool $topPadding = false;
    protected bool $bottomPadding = false;
    protected bool $bottomBorder = false;


    protected string $tabName;


    public function __construct(int $x, int $yReserve, string $tabName)
    {
        parent::__construct($x, $yReserve);
        $this->tabName = $tabName;
    }


    public function getInside(): array
    {
        return [];
    }


    public function getTabs(): array
    {
        return [];
    }
}
