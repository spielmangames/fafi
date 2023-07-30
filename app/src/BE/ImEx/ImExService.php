<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx;

use FAFI\data\CsvFileHandlerInterface;
use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\Import\Importer;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\CityConfig;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ClubConfig;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\CountryConfig;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\PlayerConfig;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\PositionConfig;

class ImExService
{
    public const FILE_EXT = CsvFileHandlerInterface::FILE_EXT;


    private CountryConfig $countryImportConfig;
    private CityConfig $cityImportConfig;
    private ClubConfig $clubImportConfig;
    private PositionConfig $positionImportConfig;
    private PlayerConfig $playerImportConfig;

    private Importer $importer;

    public function __construct()
    {
        $this->countryImportConfig = new CountryConfig();
        $this->cityImportConfig = new CityConfig();
        $this->clubImportConfig = new ClubConfig();
        $this->positionImportConfig = new PositionConfig();
        $this->playerImportConfig = new PlayerConfig();

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
        $this->importer->import($filePath, $this->countryImportConfig);
    }

    /**
     * @param string $filePath
     *
     * @return void
     * @throws FafiException
     */
    public function importCities(string $filePath): void
    {
        $this->importer->import($filePath, $this->cityImportConfig);
    }

    /**
     * @param string $filePath
     *
     * @return void
     * @throws FafiException
     */
    public function importClubs(string $filePath): void
    {
        $this->importer->import($filePath, $this->clubImportConfig);
    }

    /**
     * @param string $filePath
     *
     * @return void
     * @throws FafiException
     */
    public function importPositions(string $filePath): void
    {
        $this->importer->import($filePath, $this->positionImportConfig);
    }

    /**
     * @param string $filePath
     *
     * @return void
     * @throws FafiException
     */
    public function importPlayers(string $filePath): void
    {
        $this->importer->import($filePath, $this->playerImportConfig);
    }
}
