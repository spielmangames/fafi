<?php

require_once 'app/boot/bootstrap.php';

use FAFI\entity\FAFI;
use FAFI\entity\Player\Player;
use FAFI\entity\Player\PlayersFilter;


//----------------------------------------------------------------------------------------------------------------------


function demoRepo(FAFI $fafi)
{
    $playerService = $fafi->getPlayerService();


    // read
    $filter = new PlayersFilter();
    $players = $playerService->read($filter);
    $filter2 = new PlayersFilter([18, 19, 20]);
    $players2 = $playerService->read($filter2);


    // create...
    $player = new Player(null, null, null, 'Serginho' . time(), 'Serjinio' . time(), null, null, null);
    $player = $playerService->create($player);


    // update...
    // delete...
}

function demoFront(FAFI $fafi) {
    $playerService = $fafi->getPlayerService();
    $filter = new PlayersFilter([18]);
    $players = $playerService->read($filter);

    $storefrontService = $fafi->getStorefrontService();

    foreach ($players as $player) {
        $playerReadPage = $storefrontService->getPlayerReadPage($player);

        foreach ($playerReadPage->getTabsList() as $tab) {
            $content = $playerReadPage->initTab($tab)->getContent();

            echo $content;
            echo EOL;
        }
        echo EOL;
    }
}


//----------------------------------------------------------------------------------------------------------------------


echo EOL;
echo('FAFI 2021: started.');
echo EOL;


$fafi = new FAFI();

//demoRepo($fafi);
demoFront($fafi);



echo EOL;
echo('FAFI 2021: finished.');
echo EOL;

