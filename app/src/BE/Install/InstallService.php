<?php

declare(strict_types=1);

namespace FAFI\src\BE\Install;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Service\ServiceInterface;

class InstallService implements ServiceInterface
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

    /**
     * @param bool $cleanup
     *
     * @return void
     * @throws FafiException
     */
    public function installSamplePlayers(bool $cleanup): void
    {
        if ($cleanup) {
            $this->databaseInstaller->dropDbPlayersData();
        }

        $this->dataInstaller->installPlayerModule();
    }
}
