<?php

namespace FAFI\demo;

use FAFI\data\CsvFileHandlerInterface;
use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\ImExService;
use FAFI\src\BE\Install\InstallService;

class DemoImportService
{
    private InstallService $installService;
    private ImExService $imExService;

    public function __construct(InstallService $installService, ImExService $imExService)
    {
        $this->installService = $installService;
        $this->imExService = $imExService;
    }


    /**
     * [QC.Import_Players.01] C(full_header)
     *
     * @return void
     * @throws FafiException
     */
    public function demoImportNewPlayers(): void
    {
        $filePath = $this->installService->getSampleDataDirPath() . 'players' . CsvFileHandlerInterface::FILE_EXT;
        $this->imExService->importEntity($filePath, ImExService::ENTITIES_PLAYERS);
    }
}
