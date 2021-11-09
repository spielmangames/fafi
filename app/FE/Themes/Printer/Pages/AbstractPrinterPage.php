<?php

namespace FAFI\FE\Themes\Printer\Pages;

use FAFI\entity\Player\Player;
use FAFI\FE\Themes\Printer\PrinterDesign as PD;

abstract class AbstractPrinterPage
{
    protected string $pagePadding;
    protected string $pageBorder;


    public function getSectionY(
        int $ySize,
        bool $yTopBorder,
        bool $yTopPadding,
        bool $yBottomPadding,
        bool $yBottomBorder
    ): int {
        $frame = (int)$yTopBorder + (int)$yTopPadding + (int)$yBottomPadding + (int)$yBottomBorder;
        return $ySize - $frame;
    }


    private function setPageBorder(): void
    {
        $this->pageBorder = str_repeat(PD::PAGE_X_BORDER, PD::PAGE_X_SIZE);
    }

    public function getPageBorder(): string
    {
        if(!isset($this->pageBorder)) {
            $this->setPageBorder();
        }

        return $this->pageBorder;
    }

    private function setPagePadding(): void
    {
        $this->pagePadding = str_repeat(PD::PAGE_BASE, PD::PAGE_X_SIZE);
    }

    public function getPagePadding(): string
    {
        if(!isset($this->pagePadding)) {
            $this->setPagePadding();
        }

        return $this->pagePadding;
    }

    public function alignCenter(string $text, int $width, string $base): string
    {
        $fill = $width - mb_strlen($text);
        $left = intdiv($fill, 2);
        $right = $fill - $left;

        return str_repeat($base, $left) . $text . str_repeat($base, $right);
    }

    public function buildFullName(Player $player): string
    {
        $fullName = [];

        $name = $player->getName();
        if ($name) {
            $fullName[] = $name;
        }

        $particle = $player->getParticle();
        if ($particle) {
            $fullName[] = $particle;
        }

        $fullName[] = $player->getSurname();

        return implode(PD::PAGE_BASE, $fullName);
    }

    public function fillBefore(bool $topBorder, bool $topPadding): array
    {
        $section = [];

        if ($topBorder) {
            $section[] = $this->getPageBorder();
        }
        if ($topPadding) {
            $section[] = $this->getPagePadding();
        }

        return $section;
    }

    public function fillAfter(bool $bottomPadding, bool $bottomBorder, int $ySize): array
    {
        $section = [];

        for ($y = 1; $y <= $ySize; $y++) {
            $section[] = $this->getPagePadding();
        }
        if ($bottomPadding) {
            $section[] = $this->getPagePadding();
        }
        if ($bottomBorder) {
            $section[] = $this->getPageBorder();
        }

        return $section;
    }
}
