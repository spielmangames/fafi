<?php

namespace FAFI\src\BE;

use FAFI\src\BE\GeoCountry\CountryService;
use FAFI\src\BE\ImEx\ImExService;
use FAFI\src\BE\Install\InstallService;
use FAFI\src\BE\Player\PlayerService;
use FAFI\src\BE\Position\PositionService;
use FAFI\src\FE\StorefrontService;
use FAFI\src\FE\Themes\ThemeFactory;

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
