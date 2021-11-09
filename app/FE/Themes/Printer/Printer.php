<?php

namespace FAFI\FE\Themes\Printer;

use FAFI\entity\Player\Player;
use FAFI\FE\PageInterface;
use FAFI\FE\Themes\Printer\Pages\Player\PlayerPage;
use FAFI\FE\Themes\ThemeInterface;

class Printer implements ThemeInterface
{
    public function getPlayerReadPage(Player $player): PageInterface
    {
        return new PlayerPage($player);
    }
}
