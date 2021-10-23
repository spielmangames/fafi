<?php

use FAFI\entity\Player\PlayerService;
use FAFI\entity\Player\Repository\PlayerResource;

require_once 'app/boot/bootstrap.php';


$playerService = new PlayerService();
$playerService->create([PlayerResource::FAFI_NAME => 'test']);


