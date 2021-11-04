<?php

namespace FAFI\FE;

use FAFI\entity\Player\Player;
use FAFI\exception\FafiException;
use FAFI\FE\Themes\ThemeFactory;
use FAFI\FE\Themes\ThemeInterface;

class StorefrontService
{
    private ThemeInterface $theme;

    /**
     * StorefrontService constructor.
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