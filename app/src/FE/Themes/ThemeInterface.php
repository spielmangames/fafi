<?php

declare(strict_types=1);

namespace FAFI\src\FE\Themes;

use FAFI\src\BE\Domain\Dto\Player\Player\Player;
use FAFI\src\FE\Structure\Page\PageInterface;

interface ThemeInterface
{
    /**
     * @param Player[] $players
     * @return PageInterface
     */
    public function getPlayersListPage(array $players): PageInterface;

    public function getPlayerReadPage(Player $player): PageInterface;
}
