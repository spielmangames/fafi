<?php

// !!! TEMP !!! must be replaced with Tests + Fafi App UI facade accordingly

require_once 'app/boot/bootstrap.php';

use FAFI\demo\DemoFrontService;
use FAFI\demo\DemoImportService;
use FAFI\demo\DemoInstallService;
use FAFI\demo\DemoPlayerRepo;
use FAFI\exception\FafiException;
use FAFI\FAFI;


/**
 * @param FAFI $fafi
 * @throws FafiException
 */
function demoPlayerService(FAFI $fafi)
{
    $session = new DemoPlayerRepo(
        $fafi->getPlayerService()->getPlayerRepo(),
        $fafi->getPlayerService()->getPositionRepo()
    );

    $session->demoModifyScenario();
    $session->demoListSimpleScenario();
//    $session->demoListAdvancedScenario();
}


/**
 * @param FAFI $fafi
 * @throws FafiException
 */
function demoImport(FAFI $fafi)
{
    $session = new DemoImportService($fafi->getInstallService(), $fafi->getImExService());
    $session->demoImportNewPlayers();
}


/**
 * @param FAFI $fafi
 * @throws FafiException
 */
function demoInstall(FAFI $fafi)
{
    $session = new DemoInstallService($fafi->getInstallService());
    $session->demoInstall();
}


/**
 * @param FAFI $fafi
 * @throws FafiException
 */
function demoFront(FAFI $fafi)
{
    $session = new DemoFrontService($fafi->getPlayerService()->getPlayerRepo(), $fafi->getStorefrontService());
    $session->demoPlayerReadPage();
}

