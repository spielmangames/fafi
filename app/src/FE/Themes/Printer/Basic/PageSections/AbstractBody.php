<?php

declare(strict_types=1);

namespace FAFI\src\FE\Themes\Printer\Basic\PageSections;

abstract class AbstractBody extends AbstractPrinterPageSection
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


    abstract public function getInside(): array;
}
