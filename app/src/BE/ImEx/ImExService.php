<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx;

use FAFI\data\CsvFileHandlerInterface;
use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\Entity\Importer;

class ImExService
{
    public const FILE_EXT = CsvFileHandlerInterface::FILE_EXT;


    private Importer $importer;

    public function __construct()
    {
        $this->importer = new Importer();
    }


    /**
     * @param string $filePath
     *
     * @return void
     * @throws FafiException
     */
    public function importCountries(string $filePath): void
    {
        $this->importer->import($filePath);
    }

    /**
     * @param string $filePath
     *
     * @return void
     * @throws FafiException
     */
    public function importCities(string $filePath): void
    {
        $this->importer->import($filePath);
    }

    /**
     * @param string $filePath
     *
     * @return void
     * @throws FafiException
     */
    public function importPositions(string $filePath): void
    {
        $this->importer->import($filePath);
    }

    /**
     * @param string $filePath
     *
     * @return void
     * @throws FafiException
     */
    public function importPlayers(string $filePath): void
    {
        $this->importer->import($filePath);
    }
}
