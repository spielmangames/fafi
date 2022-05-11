<?php

namespace FAFI\src\FE;

use FAFI\BE\Player\Player;
use FAFI\exception\FafiException;
use FAFI\src\FE\Structure\Page\PageInterface;
use FAFI\src\FE\Themes\ThemeFactory;
use FAFI\src\FE\Themes\ThemeInterface;

class StorefrontService
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


    public function getPlayerReadPage(Player $player): PageInterface
    {
        return $this->theme->getPlayerReadPage($player);
    }
}
