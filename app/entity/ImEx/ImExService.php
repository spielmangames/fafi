<?php

namespace FAFI\entity\ImEx;

use FAFI\data\CsvFileHandlerInterface;
use FAFI\entity\ImEx\Entity\ImportCountries;
use FAFI\entity\ImEx\Entity\ImportPlayers;
use FAFI\entity\ImEx\Entity\ImportPositions;
use FAFI\exception\FafiException;

class ImExService
{
    public const FILE_EXT = CsvFileHandlerInterface::FILE_EXT;


    public const ENTITIES_COUNTRIES = 'countries';
    public const ENTITIES_POSITIONS = 'positions';
    public const ENTITIES_PLAYERS = 'players';

    private const E_ENTITY_IMPORT_NOT_SUPPORTED = 'Entity "%s" is not supported for Import.';


    private ImportCountries $importCountries;
    private ImportPositions $importPositions;
    private ImportPlayers $importPlayers;


    public function __construct()
    {
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
                throw new FafiException(sprintf(self::E_ENTITY_IMPORT_NOT_SUPPORTED, $entityName));
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
