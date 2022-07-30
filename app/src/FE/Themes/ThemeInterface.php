<?php

namespace FAFI\src\FE\Themes;

use FAFI\src\BE\Domain\Player\Player\Player;
use FAFI\src\FE\Structure\Page\PageInterface;

interface ThemeInterface
{
    public function getPlayerReadPage(Player $player): PageInterface;
}
