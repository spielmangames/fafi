<?php

// !!! TEMP FILE !!! must be replaced with Tests + Fafi App UI facade accordingly

require_once 'app/boot/bootstrap.php';

use FAFI\entity\FAFI;
use FAFI\entity\ImEx\ImExService;
use FAFI\entity\Player\Player;
use FAFI\entity\Player\PlayerService;
use FAFI\entity\Player\Repository\PlayersFilter;
use FAFI\exception\FafiException;


/**
 * @param FAFI $fafi
 * @throws FafiException
 */
function demoInstall(FAFI $fafi)
{
    $installService = $fafi->getInstallService();

    $installService->installDbSchema();
    $installService->installSampleData();
}


/**
 * @param FAFI $fafi
 * @throws FafiException
 */
function demoImport(FAFI $fafi)
{
    $imExService = $fafi->getImExService();
    $testDirPath = PATH_STORAGE . 'in_test' . DS;

    $filePath = $testDirPath . '_test_players_setA.csv';
    $imExService->importEntity($filePath, ImExService::ENTITIES_PLAYERS);
}


/**
 * @param FAFI $fafi
 * @throws FafiException
 */
function demoPlayerService(FAFI $fafi)
{
    $playerService = $fafi->getPlayerService();

    $filtersRead = [
        'all' =>  new PlayersFilter(),
        'by IDs' =>  new PlayersFilter([18, 19, 20]),

        'with: surname contains "Rose"' =>  new PlayersFilter(),
        'with: att_min from 3 & def_min from 1 & def_min to 3' =>  new PlayersFilter(),
        'with: att_min from 3 & def_min from 1 & position is CM & foot is R' =>  new PlayersFilter(),
        'with: Nationality & age range' =>  new PlayersFilter(),
    ];

    $selection = demoPlayerServiceRead($playerService, $filtersRead);
    var_dump($selection);
}

/**
 * @param PlayerService $playerService
 * @param PlayersFilter[] $filters
 *
 * @return Player[]
 * @throws FafiException
 */
function demoPlayerServiceRead(PlayerService $playerService, array $filters): array
{
    $result = [];
    foreach ($filters as $f => $filter) {
        $players = $playerService->read($filter);
        $result[$f] = $players;
    }

    return $result;
}


/**
 * @param FAFI $fafi
 * @throws FafiException
 */
function demoFront(FAFI $fafi)
{
    $playerService = $fafi->getPlayerService();

    $filter = new PlayersFilter([18]);
    $players = $playerService->read($filter);


    $storefrontService = $fafi->getStorefrontService();

    foreach ($players as $player) {
        $playerReadPage = $storefrontService->getPlayerReadPage($player);

        foreach ($playerReadPage->getTabsList() as $tab) {
            $content = $playerReadPage->setTabName($tab)->forPrint();

            echo $content;
            echo EOL;
        }
        echo EOL;
    }
}
