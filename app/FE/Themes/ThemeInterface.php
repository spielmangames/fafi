<?php

namespace FAFI\FE\Themes;

use FAFI\entity\Player\Player;
use FAFI\FE\Structure\Page\PageInterface;

interface ThemeInterface
{
    public function getPlayerReadPage(Player $player): PageInterface;
}
