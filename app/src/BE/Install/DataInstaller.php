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
        $this->imExService->import($this->formSampleFilePath(ImExableEntities::COUNTRIES));
        $this->imExService->import($this->formSampleFilePath(ImExableEntities::CITIES));
    }

    /**
     * @return void
     * @throws FafiException
     */
    private function installTeams(): void
    {
        $this->imExService->import($this->formSampleFilePath(ImExableEntities::CLUBS));
    }

    /**
     * @return void
     * @throws FafiException
     */
    private function installPlayer(): void
    {
        $this->imExService->import($this->formSampleFilePath(ImExableEntities::POSITIONS));
        $this->imExService->import($this->formSampleFilePath(ImExableEntities::PLAYERS));
    }


    public function formSampleFilePath(string $entityName): string
    {
        return self::IMEX_SAMPLE_DIR_PATH . $entityName . ImExService::FILE_EXT;
    }
}
