<?php

namespace FAFI\FE\Themes\Printer\Basic\PageSections;

use FAFI\FE\Structure\PageSection\PageSectionInterface;
use FAFI\FE\Themes\Printer\PrinterDesign as PD;
use FAFI\FE\Themes\Printer\PrinterHelperTrait;

abstract class AbstractPrinterPageSection implements PageSectionInterface
{
    use PrinterHelperTrait;


    private string $border;
    private string $padding;


    protected int $x;
    protected int $y;

    protected int $yReserve;
    protected bool $topBorder;
    protected bool $topPadding;
    protected bool $bottomPadding;
    protected bool $bottomBorder;


    public function __construct(int $x, int $yReserve)
    {
        $this->x = $x;
        $this->yReserve = $yReserve;
    }

    public function getX(): int
    {
        return $this->x;
    }

    private function setY(): void
    {
        $frame = (int)$this->topBorder + (int)$this->topPadding + (int)$this->bottomPadding + (int)$this->bottomBorder;
        $this->y = $this->yReserve - $frame;
    }

    public function getY(): int
    {
        if(!isset($this->y)) {
            $this->setY();
        }

        return $this->y;
    }

    public function getYReserve(): int
    {
        return $this->yReserve;
    }


    private function setBorder(): void
    {
        $this->border = str_repeat(PD::PAGE_X_BORDER, PD::PAGE_X_SIZE);
    }

    public function getBorder(): string
    {
        if(!isset($this->border)) {
            $this->setBorder();
        }

        return $this->border;
    }

    private function setPadding(): void
    {
        $this->padding = str_repeat(PD::PAGE_BASE, PD::PAGE_X_SIZE);
    }

    public function getPadding(): string
    {
        if(!isset($this->padding)) {
            $this->setPadding();
        }

        return $this->padding;
    }


    public function getContent(): array
    {
        $before = $this->fillBefore($this->topBorder, $this->topPadding);
        $inside = $this->getInside();
        $after = $this->fillAfter($this->bottomPadding, $this->bottomBorder, $this->getY() - count($inside));

        return array_merge($before, $inside, $after);
    }

    private function fillBefore(bool $topBorder, bool $topPadding): array
    {
        $section = [];

        if ($topBorder) {
            $section[] = $this->getBorder();
        }
        if ($topPadding) {
            $section[] = $this->getPadding();
        }

        return $section;
    }

    private function fillAfter(bool $bottomPadding, bool $bottomBorder, int $ySize): array
    {
        $section = [];

        for ($y = 1; $y <= $ySize; $y++) {
            $section[] = $this->getPadding();
        }
        if ($bottomPadding) {
            $section[] = $this->getPadding();
        }
        if ($bottomBorder) {
            $section[] = $this->getBorder();
        }

        return $section;
    }
}
