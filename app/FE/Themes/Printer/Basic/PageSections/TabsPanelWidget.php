<?php

namespace FAFI\FE\Themes\Printer\Basic\PageSections;

use FAFI\exception\FafiException;
use FAFI\FE\Themes\Printer\PrinterDesign as PD;

class TabsPanelWidget extends AbstractWidget
{
    protected int $yReserve = 1;


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
        return [$this->alignLeft($this->prepareContent(), $this->getX(), PD::PAGE_X_BORDER)];
    }

    /**
     * @return string
     * @throws FafiException
     */
    protected function prepareContent(): string
    {
        return implode(PD::PAGE_X_BORDER, $this->handleTabsList());
    }

    /**
     * @return array
     * @throws FafiException
     */
    private function handleTabsList(): array
    {
        $tabs = [];

        if (!in_array($this->activeTab, $this->tabsList)) {
            throw new FafiException(sprintf(FafiException::E_TAB_NOT_SUPPORTED, $this->activeTab, self::class));
        }

        $activeHandled = false;
        foreach ($this->tabsList as $tabName) {
            if (!$activeHandled && $tabName === $this->activeTab) {
                $tabName = $this->handleActiveTab($tabName);
                $activeHandled = true;
            } else {
                $tabName = $this->handlePassiveTab($tabName);
            }

            $tabs[] = $tabName;
        }

        return $tabs;
    }

    private function handleActiveTab(string $tabName): string
    {
        return PD::PAGE_Y_BORDER . $tabName . PD::PAGE_Y_BORDER;
    }

    private function handlePassiveTab(string $tabName): string
    {
        return $tabName = substr($tabName, 0, $this->passiveTabTrim);
    }
}
