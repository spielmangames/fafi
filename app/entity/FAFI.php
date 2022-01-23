<?php

namespace FAFI\entity;

use FAFI\entity\Player\PlayerService;
use FAFI\entity\Position\Position;
use FAFI\entity\Position\PositionService;
use FAFI\FE\StorefrontService;
use FAFI\FE\Themes\ThemeFactory;

class FAFI
{
    // BE
    private PlayerService $playerService;
    private PositionService $positionService;
//    private ClubService $clubService;
//    private NationService $nationService;

    // FE
    private StorefrontService $storefrontService;


    public function __construct()
    {
        $this->playerService = new PlayerService();
        $this->positionService = new PositionService();
//        $this->clubService = new ClubService();
//        $this->nationService = new NationService();

        $this->storefrontService = new StorefrontService(ThemeFactory::THEME_PRINTER);
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
