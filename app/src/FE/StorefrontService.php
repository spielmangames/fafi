<?php

declare(strict_types=1);

namespace FAFI\src\FE;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;
use FAFI\src\BE\Domain\Service\PlayerService;
use FAFI\src\FE\Structure\Page\PageInterface;
use FAFI\src\BE\Domain\Service\ServiceInterface;
use FAFI\src\FE\Themes\ThemeFactory;
use FAFI\src\FE\Themes\ThemeInterface;

class StorefrontService implements ServiceInterface
{
    private ThemeInterface $theme;
    private PlayerService $playerService;

    /**
     * @param string $themeName
     * @throws FafiException
     */
    public function __construct(string $themeName)
    {
        $this->theme = $this->createTheme($themeName);
        $this->playerService = new PlayerService();
    }

    /**
     * @param string $themeName
     *
     * @return ThemeInterface
     * @throws FafiException
     */
    private function createTheme(string $themeName): ThemeInterface
    {
        $themeFactory = new ThemeFactory();
        return $themeFactory->create($themeName);
    }


    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return PageInterface
     * @throws FafiException
     */
    public function getPlayersListPage(array $conditions): PageInterface
    {
        $players = $this->playerService->findPlayersCollection($conditions);
        return $this->theme->getPlayersListPage($players);
    }

    /**
     * @param int $playerId
     *
     * @return PageInterface
     * @throws FafiException
     */
    public function getPlayerReadPage(int $playerId): PageInterface
    {
        $player = $this->playerService->findPlayerById($playerId);
        return $this->theme->getPlayerReadPage($player);
    }
}
