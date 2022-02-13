<?php

namespace FAFI\entity;

use FAFI\entity\GeoCountry\CountryService;
use FAFI\entity\ImEx\ImExService;
use FAFI\entity\Install\InstallService;
use FAFI\entity\Player\PlayerService;
use FAFI\entity\Position\PositionService;
use FAFI\FE\StorefrontService;
use FAFI\FE\Themes\ThemeFactory;

class FAFI
{
    // BE technical
    private InstallService $installService;
    private ImExService $imExService;

    // BE domain
    private CountryService $countryService;
    private PlayerService $playerService;
    private PositionService $positionService;

    // FE
    private StorefrontService $storefrontService;


    public function __construct()
    {
        $this->installService = new InstallService();
        $this->imExService = new ImExService();

        $this->countryService = new CountryService();
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


    public function getCountryService(): CountryService
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
