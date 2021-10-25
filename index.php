<?php

use FAFI\entity\FAFI;
use FAFI\entity\Player\Player;
use FAFI\entity\Player\PlayersFilter;

require_once 'app/boot/bootstrap.php';


$fafi = new FAFI();
$playerService = $fafi->getPlayerService();


$filter = new PlayersFilter([18]);
$player = $playerService->read($filter);

$player = new Player(null, null, null, 'Serginho' . time(), 'Serjinio' . time(), null, null, null);
$player = $playerService->create($player);


$zzz = 1;
