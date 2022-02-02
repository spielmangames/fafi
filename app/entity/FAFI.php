<?php

namespace FAFI\entity;

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
    private PlayerService $playerService;
    private PositionService $positionService;
//    private PlayerAttributeService $playerAttributeService;
//    private ClubService $clubService;
//    private NationService $nationService;

    // FE
    private StorefrontService $storefrontService;


    public function __construct()
    {
        $this->installService = new InstallService();
        $this->imExService = new ImExService();

        $this->playerService = new PlayerService();
        $this->positionService = new PositionService();
//        $this->clubService = new ClubService();
//        $this->nationService = new NationService();

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
