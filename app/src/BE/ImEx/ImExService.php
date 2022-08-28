<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx;

use FAFI\data\CsvFileHandlerInterface;
use FAFI\exception\FafiException;
use FAFI\exception\ImExErr;
use FAFI\src\BE\ImEx\Entity\ImporterCities;
use FAFI\src\BE\ImEx\Entity\ImporterCountries;
use FAFI\src\BE\ImEx\Entity\ImporterPlayers;
use FAFI\src\BE\ImEx\Entity\ImporterPositions;

class ImExService
{
    public const FILE_EXT = CsvFileHandlerInterface::FILE_EXT;


    public const ENTITIES_COUNTRIES = 'countries';
    public const ENTITIES_CITIES = 'cities';

    public const ENTITIES_POSITIONS = 'positions';
    public const ENTITIES_PLAYERS = 'players';


    private ImporterCountries $importCountries;
    private ImporterCities $importCities;

    private ImporterPositions $importPositions;
    private ImporterPlayers $importPlayers;


    public function __construct()
    {
        $this->importCountries = new ImporterCountries();
        $this->importCities = new ImporterCities();

        $this->importPositions = new ImporterPositions();
        $this->importPlayers = new ImporterPlayers();
    }


    /**
     * @param string $filePath
     * @param string $entityName
     *
     * @return void
     * @throws FafiException
     */
    public function import(string $filePath, string $entityName): void
    {
        switch ($entityName) {
            case self::ENTITIES_COUNTRIES:
                $this->importCountries($filePath);
                break;
            case self::ENTITIES_CITIES:
                $this->importCities($filePath);
                break;

            case self::ENTITIES_POSITIONS:
                $this->importPositions($filePath);
                break;
            case self::ENTITIES_PLAYERS:
                $this->importPlayers($filePath);
                break;
        }

        throw new FafiException(sprintf(ImExErr::ENTITY_IMPORT_NOT_SUPPORTED, $entityName));
    }


    /**
     * @param string $filePath
     *
     * @return void
     * @throws FafiException
     */
    private function importCountries(string $filePath): void
    {
        $this->importCountries->import($filePath);
    }

    /**
     * @param string $filePath
     *
     * @return void
     * @throws FafiException
     */
    private function importCities(string $filePath): void
    {
        $this->importCities->import($filePath);
    }

    /**
     * @param string $filePath
     *
     * @return void
     * @throws FafiException
     */
    private function importPositions(string $filePath): void
    {
        $this->importPositions->import($filePath);
    }

    /**
     * @param string $filePath
     *
     * @return void
     * @throws FafiException
     */
    private function importPlayers(string $filePath): void
    {
        $this->importPlayers->import($filePath);
    }
}
