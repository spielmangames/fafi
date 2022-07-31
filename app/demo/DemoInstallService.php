<?php

namespace FAFI\demo;

use FAFI\exception\FafiException;
use FAFI\src\BE\Install\InstallService;

class DemoInstallService
{
    private InstallService $installService;

    public function __construct(InstallService $installService)
    {
        $this->installService = $installService;
    }


    /**
     * [QC.Install.01] DB
     *
     * @return void
     * @throws FafiException
     */
    public function demoInstall(): void
    {
        $this->installService->installSample();
    }
}
