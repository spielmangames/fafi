<?php

namespace FAFI\FE\Themes;

use FAFI\entity\Player\Player;
use FAFI\FE\PageInterface;

interface ThemeInterface
{
    public function getPlayerReadPage(Player $player): PageInterface;
}
