<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx;

use FAFI\data\CsvFileHandlerInterface;
use FAFI\exception\FafiException;
use FAFI\exception\ImExErr;
use FAFI\src\BE\ImEx\Entity\ImportCountries;
use FAFI\src\BE\ImEx\Entity\ImportPlayers;
use FAFI\src\BE\ImEx\Entity\ImportPositions;

class ImExService
{
    public const FILE_EXT = CsvFileHandlerInterface::FILE_EXT;


    public const ENTITIES_COUNTRIES = 'countries';
    public const ENTITIES_POSITIONS = 'positions';
    public const ENTITIES_PLAYERS = 'players';


    private ImportCountries $importCountries;
    private ImportPositions $importPositions;
    private ImportPlayers $importPlayers;


    public function __construct()
    {
        $this->importCountries = new ImportCountries();
        $this->importPositions = new ImportPositions();
        $this->importPlayers = new ImportPlayers();
    }


    /**
     * @param string $filePath
     * @param string $entityName
     *
     * @return void
     * @throws FafiException
     */
    public function importEntity(string $filePath, string $entityName): void
    {
        switch ($entityName) {
            case self::ENTITIES_COUNTRIES:
                $this->importCountries($filePath);
                break;
            case self::ENTITIES_POSITIONS:
                $this->importPositions($filePath);
                break;
            case self::ENTITIES_PLAYERS:
                $this->importPlayers($filePath);
                break;

            default:
                throw new FafiException(sprintf(ImExErr::ENTITY_IMPORT_NOT_SUPPORTED, $entityName));
        }
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
