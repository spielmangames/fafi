<?php

declare(strict_types=1);

namespace FAFI\src\FE;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\Player\Player\Player;
use FAFI\src\FE\Structure\Page\PageInterface;
use FAFI\src\BE\Domain\Service\ServiceInterface;
use FAFI\src\FE\Themes\ThemeFactory;
use FAFI\src\FE\Themes\ThemeInterface;

class StorefrontService implements ServiceInterface
{
    private ThemeInterface $theme;

    /**
     * @param string $themeName
     * @throws FafiException
     */
    public function __construct(string $themeName)
    {
        $themeFactory = new ThemeFactory();
        $this->theme = $themeFactory->create($themeName);
    }

    public function getTheme(): ThemeInterface
    {
        return $this->theme;
    }


    public function getPlayersListPage(array $players): PageInterface
    {
        return $this->theme->getPlayersListPage($players);
    }

    public function getPlayerReadPage(Player $player): PageInterface
    {
        return $this->theme->getPlayerReadPage($player);
    }
}
