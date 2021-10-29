<?php

use FAFI\entity\FAFI;
use FAFI\entity\Player\Player;
use FAFI\entity\Player\PlayersFilter;

require_once 'app/boot/bootstrap.php';


$fafi = new FAFI();
$playerService = $fafi->getPlayerService();


// TESTING:

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

$zzz = 1;
