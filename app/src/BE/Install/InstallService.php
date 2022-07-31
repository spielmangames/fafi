<?php

namespace FAFI\src\BE\Install;

use FAFI\exception\FafiException;

class InstallService
{
    private DatabaseInstaller $databaseInstaller;
    private DataInstaller $dataInstaller;

    public function __construct()
    {
        $this->databaseInstaller = new DatabaseInstaller();
        $this->dataInstaller = new DataInstaller();
    }


    public function getSampleDataDirPath(): string
    {
        return $this->dataInstaller::IMEX_SAMPLE_DIR_PATH;
    }

    /**
     * @return void
     * @throws FafiException
     */
    public function installSample(): void
    {
        $this->databaseInstaller->installDbSchema();
        $this->dataInstaller->installSampleData();
    }
}
