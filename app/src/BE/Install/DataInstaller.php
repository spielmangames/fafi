<?php

declare(strict_types=1);

namespace FAFI\src\BE\Install;

use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\ImExService;

class DataInstaller
{
    public const IMEX_SAMPLE_DIR_PATH = PATH_STORAGE . 'sample' . DS;

    private const SAMPLE_FILEPATH_COUNTRIES = 'countries.csv';
    private const SAMPLE_FILEPATH_CITIES = 'cities.csv';
    private const SAMPLE_FILEPATH_CLUBS = 'clubs.csv';
    private const SAMPLE_FILEPATH_POSITIONS = 'positions.csv';
    private const SAMPLE_FILEPATH_PLAYERS = 'players.csv';


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
        $this->imExService->importCountries($this->formSampleFilePath(self::SAMPLE_FILEPATH_COUNTRIES));
        $this->imExService->importCities($this->formSampleFilePath(self::SAMPLE_FILEPATH_CITIES));
    }

    /**
     * @return void
     * @throws FafiException
     */
    private function installTeams(): void
    {
        $this->imExService->importClubs($this->formSampleFilePath(self::SAMPLE_FILEPATH_CLUBS));
    }

    /**
     * @return void
     * @throws FafiException
     */
    private function installPlayer(): void
    {
        $this->imExService->importPositions($this->formSampleFilePath(self::SAMPLE_FILEPATH_POSITIONS));
        $this->imExService->importPlayers($this->formSampleFilePath(self::SAMPLE_FILEPATH_PLAYERS));
    }


    public function formSampleFilePath(string $fileName): string
    {
        return self::IMEX_SAMPLE_DIR_PATH . $fileName;
    }
}
