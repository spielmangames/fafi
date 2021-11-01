<?php

namespace FAFI\FE\Themes\Printer;

use FAFI\entity\Player\Player;
use FAFI\FE\PageInterface;
use FAFI\FE\PlayerPage;
use FAFI\FE\Themes\ThemeInterface;

class Printer implements ThemeInterface
{
    private PageInterface $page;

    public function setPage(PageInterface $page): self
    {
        $this->page = $page;
        return $this;
    }

    public function getPlayerReadPage(Player $player): PageInterface
    {
        return new PlayerPage($player);
    }
}
