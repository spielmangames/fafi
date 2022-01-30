<?php

namespace FAFI\entity;

use FAFI\entity\Import\ImportService;
use FAFI\entity\Install\InstallService;
use FAFI\entity\Player\PlayerService;
use FAFI\entity\Position\Position;
use FAFI\entity\Position\PositionService;
use FAFI\FE\StorefrontService;
use FAFI\FE\Themes\ThemeFactory;

class FAFI
{
    // technical
    private InstallService $installService;
    private ImportService $importService;

    // BE
    private PlayerService $playerService;
    private PositionService $positionService;
//    private ClubService $clubService;
//    private NationService $nationService;

    // FE
    private StorefrontService $storefrontService;


    public function __construct()
    {
        $this->installService = new InstallService();
        $this->importService = new ImportService();

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

    public function getImportService(): ImportService
    {
        return $this->importService;
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


    public function installData()
    {
        $importService = $this->getImportService();

        $fp = 'positions.csv';
        $importService->importPositions($fp);
    }

    private function installPositions()
    {
        foreach (Position::P_SUPPORTED as $positionName) {
            $position = new Position(null, $positionName);
            $this->positionService->create($position);
        }
    }
}
