<?php

declare(strict_types=1);

namespace FAFI\src\BE\Install;

use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\ImExableEntities;
use FAFI\src\BE\ImEx\ImExService;

class DataInstaller
{
    public const IMEX_SAMPLE_DIR_PATH = PATH_STORAGE . 'sample' . DS;


    private ImExService $imExService;

    public function __construct()
    {
        $this->imExService = new ImExService();
    }


    /**
     * @return void
     * @throws FafiException
     */
    public function installSampleData(): void
    {
        $this->installGeo();
        $this->installTeams();
        $this->installPlayer();
    }

    /**
     * @return void
     * @throws FafiException
     */
    private function installGeo(): void
    {
        $geo = ImExableEntities::GROUP_GEO;

        $this->imExService->import($this->formFilePath($geo, ImExableEntities::COUNTRIES));
        $this->imExService->import($this->formFilePath($geo, ImExableEntities::CITIES));
    }

    /**
     * @return void
     * @throws FafiException
     */
    private function installTeams(): void
    {
        $team = ImExableEntities::GROUP_TEAM;

        $this->imExService->import($this->formFilePath($team, ImExableEntities::CLUBS));
//        $this->imExService->import($this->formFilePath($team, ImExableEntities::CLUBS . ImExableEntities::TO_DO));
    }

    /**
     * @return void
     * @throws FafiException
     */
    private function installPlayer(): void
    {
        $player = ImExableEntities::GROUP_PLAYER;

        $this->imExService->import($this->formFilePath($player, ImExableEntities::POSITIONS));
        $this->imExService->import($this->formFilePath($player, ImExableEntities::PLAYERS));
//        $this->imExService->import($this->formFilePath($player, ImExableEntities::PLAYERS . ImExableEntities::TO_DO));
        $this->imExService->import($this->formFilePath($player, ImExableEntities::PLAYER_ATTRIBUTES));
    }


    private function formFilePath(string $groupName, string $entityName): string
    {
        return self::IMEX_SAMPLE_DIR_PATH . $groupName . DS . $entityName . ImExService::FILE_EXT;
    }
}
