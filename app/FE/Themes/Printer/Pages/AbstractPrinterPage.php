<?php

namespace FAFI\FE\Themes\Printer\Pages;

use FAFI\entity\Player\Player;
use FAFI\FE\Themes\Printer\PrinterDesign as PD;

abstract class AbstractPrinterPage
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
}
