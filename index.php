<?php

use FAFI\entity\FAFI;
use FAFI\entity\Player\Player;

require_once 'app/boot/bootstrap.php';


$fafi = new FAFI();
$playerService = $fafi->getPlayerService();

$player = new Player(null, null, null, 'Serginho', 'Serjinio', null, null, null);
//$player->setFoot('L');
$player = $playerService->create($player);

$zzz = 1;
