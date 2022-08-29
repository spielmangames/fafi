<?php

declare(strict_types=1);

namespace FAFI\src\FE\Themes\Printer;

use FAFI\src\BE\Domain\Dto\Player\Player\Player;
use FAFI\src\FE\Structure\Page\PageInterface;
use FAFI\src\FE\Themes\Printer\Custom\Player\PlayerPage;
use FAFI\src\FE\Themes\ThemeInterface;

class Printer implements ThemeInterface
{
    public function getPlayersListPage(array $players): PageInterface
    {
//        return new PlayerPage($players);
    }

    public function getPlayerReadPage(Player $player): PageInterface
    {
        return new PlayerPage($player);
    }
}
