<?php

// !!! TEMP FILE !!! must be replaced with Tests + Fafi App UI facade accordingly

require_once 'app/boot/bootstrap.php';

use FAFI\data\CsvFileHandlerInterface;
use FAFI\exception\FafiException;
use FAFI\FAFI;
use FAFI\src\BE\ImEx\ImExService;
use FAFI\src\BE\Player\Player;
use FAFI\src\BE\Player\PlayerService;
use FAFI\src\BE\Player\Repository\PlayersFilter;


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

    $filePath = $fafi->getInstallService()::IMEX_SAMPLE_DIR_PATH . 'players' . CsvFileHandlerInterface::FILE_EXT;
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
        'all' => new PlayersFilter(),
        'by IDs' => new PlayersFilter([18, 19, 20]),

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
        $players = $playerService->readPlayers($filter);
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
    $players = $playerService->readPlayers($filter);


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

