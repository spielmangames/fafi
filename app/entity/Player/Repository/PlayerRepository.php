<?php

namespace FAFI\entity\Player\Repository;

use FAFI\entity\Player\Player;

class PlayerRepository
{
    public function create(Player $playerData): void
    {
        $player = new Player();
        $player->setFafiName($playerData[PlayerResource::FAFI_NAME]);

        $zzz = 1;
    }
}
