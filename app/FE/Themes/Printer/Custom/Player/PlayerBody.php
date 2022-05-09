<?php

namespace FAFI\FE\Themes\Printer\Custom\Player;

use FAFI\src\Player\Player;
use FAFI\FE\Structure\PageSection\PageSectionInterface;
use FAFI\FE\Themes\Printer\Basic\PageSections\AbstractBody;
use FAFI\FE\Themes\Printer\Basic\Widgets\TabsPanelWidget;

class PlayerBody extends AbstractBody
{
    private Player $player;

    public function __construct(int $x, int $yReserve, Player $player, string $tabName)
    {
        parent::__construct($x, $yReserve, $tabName);
        $this->player = $player;
    }

    public function setEntity(Player $player): self
    {
        $this->player = $player;
        return $this;
    }


    public function getInside(): array
    {
        $tabsPanel = new TabsPanelWidget($this->getX(), PlayerPage::TABS_LIST, $this->tabName);
        $widgets = [$tabsPanel];

        $inside = [];
        foreach ($widgets as $widget) {
            /** @var PageSectionInterface $widget */
            $inside = array_merge($inside, $widget->getContent());
        }

        return $inside;
    }

//    /**
//     * @return string
//     * @throws FafiException
//     */
//    protected function prepareBodyContent(): string
//    {
//        if (!isset($this->player)) {
//            throw new FafiException(sprintf(FafiException::E_PLAYER_IS_MISSED, self::class));
//        }
//
//        return $this->asdf($this->player);
//    }
//
//    private function asdf(Player $player): string
//    {
//        return '';
//    }
}
