<?php

namespace FAFI\FE\Themes\Printer\Basic\Widgets;

use FAFI\exception\FafiException;
use FAFI\FE\Themes\Printer\Basic\PageSections\AbstractWidget;
use FAFI\FE\Themes\Printer\PrinterDesign as PD;

class TabsPanelWidget extends AbstractWidget
{
    protected int $yReserve = 1;

    protected bool $topBorder = false;
    protected bool $topPadding = false;
    protected bool $bottomPadding = true;
    protected bool $bottomBorder = false;


    private array $tabsList;
    private string $activeTab;
    private int $passiveTabTrim;

    public function __construct(int $x, array $tabsList, string $activeTab, int $passiveTabTrim = 3)
    {
        parent::__construct($x, $this->yReserve);

        $this->tabsList = $tabsList;
        $this->activeTab = $activeTab;
        $this->passiveTabTrim = $passiveTabTrim;
    }


    /**
     * @return array
     * @throws FafiException
     */
    public function getInside(): array
    {
        return [$this->alignLeft($this->prepareTabsList(), $this->getX(), PD::PAGE_X_BORDER)];
    }

    /**
     * @return string
     * @throws FafiException
     */
    private function prepareTabsList(): string
    {
        if (!in_array($this->activeTab, $this->tabsList)) {
            throw new FafiException(sprintf(FafiException::E_TAB_NOT_SUPPORTED, $this->activeTab, self::class));
        }

        $tabs = [];

        $activeHandled = false;
        foreach ($this->tabsList as $tabName) {
            if (!$activeHandled && $tabName === $this->activeTab) {
                $tabName = $this->prepareActiveTab($tabName);
                $activeHandled = true;
            } else {
                $tabName = $this->preparePassiveTab($tabName);
            }

            $tabs[] = $tabName;
        }

        return implode(PD::PAGE_X_BORDER, $tabs);
    }

    private function prepareActiveTab(string $tabName): string
    {
        return PD::PAGE_Y_BORDER . $tabName . PD::PAGE_Y_BORDER;
    }

    private function preparePassiveTab(string $tabName): string
    {
        return $tabName = substr($tabName, 0, $this->passiveTabTrim);
    }
}
