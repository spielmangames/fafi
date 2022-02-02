<?php

namespace FAFI\entity\ImEx;

use FAFI\entity\ImEx\Entity\ImportPositions;
use FAFI\exception\FafiException;

class ImExService
{
    public const FILE_EXT = '.csv';


    private ImportPositions $importPositions;

    public function __construct()
    {
        $this->importPositions = new ImportPositions();
    }


    /**
     * @param string $filePath
     *
     * @return void
     * @throws FafiException
     */
    public function importPositions(string $filePath): void
    {
        $this->importPositions->import($filePath);
    }
}
