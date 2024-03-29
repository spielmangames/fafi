<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Service\ServiceInterface;
use FAFI\src\BE\FileStorage\csv\CsvFileHandlerInterface;
use FAFI\src\BE\ImEx\Import\Importer;

class ImExService implements ServiceInterface
{
    public const FILE_EXT = CsvFileHandlerInterface::FILE_EXT;


    private ImportEntityConfigDetector $importEntityConfigDetector;
    private Importer $importer;

    public function __construct()
    {
        $this->importEntityConfigDetector = new ImportEntityConfigDetector();
        $this->importer = new Importer();
    }


    /**
     * @param string $filePath
     *
     * @return void
     * @throws FafiException
     */
    public function import(string $filePath): void
    {
        $this->importer->import($filePath, $this->importEntityConfigDetector->selectConfig($filePath));
    }
}
