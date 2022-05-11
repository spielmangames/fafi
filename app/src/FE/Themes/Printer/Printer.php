<?php

namespace FAFI\src\FE\Themes\Printer;

use FAFI\BE\Player\Player;
use FAFI\src\FE\Structure\Page\PageInterface;
use FAFI\src\FE\Themes\Printer\Custom\Player\PlayerPage;
use FAFI\src\FE\Themes\ThemeInterface;

class Printer implements ThemeInterface
{
    public function getPlayerReadPage(Player $player): PageInterface
    {
        return new PlayerPage($player);
    }
}
