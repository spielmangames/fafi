<?php

namespace FAFI\FE\Themes\Printer\Basic\Pages;

use FAFI\FE\Structure\Page\PageInterface;
use FAFI\FE\Themes\Printer\PrinterDesign as PD;

abstract class AbstractPrinterPage implements PageInterface
{
    protected string $pageBorder;


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


    public function calcBodyYReserve(): int
    {
        $h = $this->getHeader()->getYReserve();
        $t = $this->getTitle()->getYReserve();
        $f = $this->getFooter()->getYReserve();

        return PD::PAGE_Y_SIZE - ($h + $t + $f);
    }
}
