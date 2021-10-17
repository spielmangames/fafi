<?php

namespace FAFI\entity\Player;

use FAFI\entity\Player\Repository\PlayerResource;

class PlayerService
{
    public function create(array $playerData): void
    {
        $player = new Player();
        $player->setFafiName($playerData[PlayerResource::FAFI_NAME]);

        $zzz = 1;
    }
}
