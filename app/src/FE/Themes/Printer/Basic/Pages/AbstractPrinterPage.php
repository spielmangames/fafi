<?php

namespace FAFI\src\FE\Themes\Printer\Basic\Pages;

use FAFI\exception\FafiException;
use FAFI\exception\FrontErr;
use FAFI\src\FE\Structure\Page\PageInterface;
use FAFI\src\FE\Themes\Printer\PrinterDesign as PD;

abstract class AbstractPrinterPage implements PageInterface
{
    protected string $tabName;

    protected string $pageBorder;


    /**
     * @param string $tabName
     * @return PageInterface
     * @throws FafiException
     */
    public function setTabName(string $tabName): PageInterface
    {
        if (!in_array($tabName, $this->getTabsList())) {
            throw new FafiException(sprintf(FrontErr::TAB_NOT_SUPPORTED, $tabName, self::class));
        }
        $this->tabName = $tabName;

        return $this;
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


    public function calcBodyYReserve(): int
    {
        $h = $this->getHeader()->getYReserve();
        $t = $this->getTitle()->getYReserve();
        $f = $this->getFooter()->getYReserve();

        return PD::PAGE_Y_SIZE - ($h + $t + $f);
    }
}
