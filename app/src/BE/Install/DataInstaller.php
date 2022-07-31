<?php

namespace FAFI\src\BE\Install;

use FAFI\exception\FafiException;
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
        // geo
        $this->importEntity($this->imExService::ENTITIES_COUNTRIES);

        // domain
        $this->importEntity($this->imExService::ENTITIES_POSITIONS);
        $this->importEntity($this->imExService::ENTITIES_PLAYERS);
    }

    /**
     * @param string $entityName
     *
     * @return void
     * @throws FafiException
     */
    private function importEntity(string $entityName): void
    {
        $filePath = self::IMEX_SAMPLE_DIR_PATH . $entityName . ImExService::FILE_EXT;
        $this->imExService->importEntity($filePath, $entityName);
    }
}
