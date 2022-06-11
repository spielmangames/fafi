<?php

// !!! TEMP FILE !!! must be replaced with Tests + Fafi App UI facade accordingly

require_once 'app/boot/bootstrap.php';

use FAFI\data\CsvFileHandlerInterface;
use FAFI\db\QuerySyntax;
use FAFI\exception\FafiException;
use FAFI\FAFI;
use FAFI\src\BE\ImEx\ImExService;
use FAFI\src\BE\Player\Player;
use FAFI\src\BE\Player\PlayerService;
use FAFI\src\BE\Player\Repository\Criteria;
use FAFI\src\BE\Player\Repository\PlayersFilter;
use FAFI\src\BE\Structure\Repository\AbstractResource;


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
    $playerRepo = $fafi->getPlayerService()->getPlayerRepo();


    // [QC.Player.01] L(simple)
    $selection = $playerRepo->findCollection();

    $condition = new Criteria(AbstractResource::ID_FIELD, QuerySyntax::OPERATOR_IN, [18, 19, 20]);
    $filter = new PlayersFilter([18, 19, 20]);
    $selection = $playerRepo->findCollection([$condition]);


    // [QC.Player.02] L(advanced)
//        'with: surname contains "Rose"' => new PlayersFilter(),
//        'with: att_min from 3 & def_min from 1 & def_min to 3' => new PlayersFilter(),
//        'with: att_min from 3 & def_min from 1 & position is CM & foot is R' => new PlayersFilter(),
//        'with: Nationality & age range' => new PlayersFilter(),



    // [QC.Player.11] C(mandatory)+R + U(full)+R + D+R
    $player = new Player();
    $player
        ->setSurname('Serginho')
        ->setFafiSurname('Zerginho');
    $id = $playerRepo->save($player)->getId();
    $selection = $playerRepo->findById($id);

//    $selection = $playerService->updatePlayers();
//    $selection = $playerService->deletePlayers();

    var_dump($selection);
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

