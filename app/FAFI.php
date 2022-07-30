<?php

namespace FAFI;

use FAFI\src\BE\Domain\Geo\GeoService;
use FAFI\src\BE\Domain\Player\PlayerService;
use FAFI\src\BE\Domain\Position\PositionService;
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
    private GeoService $countryService;
    private PlayerService $playerService;
    private PositionService $positionService;

    // FE
    private StorefrontService $storefrontService;


    public function __construct()
    {
        $this->installService = new InstallService();
        $this->imExService = new ImExService();

        $this->countryService = new GeoService();
        $this->playerService = new PlayerService();
        $this->positionService = new PositionService();

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


    public function getCountryService(): GeoService
    {
        return $this->countryService;
    }

    public function getPlayerService(): PlayerService
    {
        return $this->playerService;
    }

    public function getPositionService(): PositionService
    {
        return $this->positionService;
    }


    public function getStorefrontService(): StorefrontService
    {
        return $this->storefrontService;
    }
}
