<?php

declare(strict_types=1);

namespace FAFI;

use FAFI\src\BE\Domain\Service\GeoService;
use FAFI\src\BE\Domain\Service\PlayerService;
use FAFI\src\BE\Domain\Service\TeamService;
use FAFI\src\BE\ImEx\ImExService;
use FAFI\src\BE\Install\InstallService;
use FAFI\src\FE\StorefrontService;
use FAFI\src\FE\Themes\ThemeFactory;

class FAFI
{
    // BE technical
    private InstallService $installService;
    private ImExService $imExService;

    // BE domain
    private GeoService $geoService;
    private TeamService $teamService;
    private PlayerService $playerService;

    // FE
    private StorefrontService $storefrontService;


    public function __construct()
    {
        $this->installService = new InstallService();
        $this->imExService = new ImExService();

        $this->geoService = new GeoService();
        $this->teamService = new TeamService();
        $this->playerService = new PlayerService();

        $this->storefrontService = new StorefrontService(ThemeFactory::THEME_PRINTER);
    }


    public function getInstallService(): InstallService
    {
        return $this->installService;
    }

    public function getImExService(): ImExService
    {
        return $this->imExService;
    }


    public function getGeoService(): GeoService
    {
        return $this->geoService;
    }

    public function getTeamService(): TeamService
    {
        return $this->teamService;
    }

    public function getPlayerService(): PlayerService
    {
        return $this->playerService;
    }


    public function getStorefrontService(): StorefrontService
    {
        return $this->storefrontService;
    }


    public function installAppWithSample(): void
    {
        $this->installService->installSample();
    }

    public function installSamplePlayers(bool $cleanupBefore): void
    {
        $this->installService->installSamplePlayers($cleanupBefore);
    }
}
