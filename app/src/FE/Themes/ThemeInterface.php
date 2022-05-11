<?php

namespace FAFI\src\FE\Themes;

use FAFI\src\BE\Player\Player;
use FAFI\src\FE\Structure\Page\PageInterface;

interface ThemeInterface
{
    public function getPlayerReadPage(Player $player): PageInterface;
}
