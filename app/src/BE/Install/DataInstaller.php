<?php

declare(strict_types=1);

namespace FAFI\src\BE\Install;

use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\ImExService;

class DataInstaller
{
    public const IMEX_SAMPLE_DIR_PATH = PATH_STORAGE . 'sample' . DS;
    private const SAMPLE_FILEPATH_COUNTRIES = self::IMEX_SAMPLE_DIR_PATH . 'countries.csv';
    private const SAMPLE_FILEPATH_CITIES = self::IMEX_SAMPLE_DIR_PATH . 'cities.csv';
    private const SAMPLE_FILEPATH_POSITIONS = self::IMEX_SAMPLE_DIR_PATH . 'positions.csv';
    private const SAMPLE_FILEPATH_PLAYERS = self::IMEX_SAMPLE_DIR_PATH . 'players.csv';


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
        $this->installPlayer();
    }

    /**
     * @return void
     * @throws FafiException
     */
    private function installGeo(): void
    {
        $this->imExService->importCountries(self::SAMPLE_FILEPATH_COUNTRIES);
        $this->imExService->importCities(self::SAMPLE_FILEPATH_CITIES);
    }

    /**
     * @return void
     * @throws FafiException
     */
    private function installPlayer(): void
    {
        $this->imExService->importPositions(self::SAMPLE_FILEPATH_POSITIONS);
        $this->imExService->importPlayers(self::SAMPLE_FILEPATH_PLAYERS);
    }
}
