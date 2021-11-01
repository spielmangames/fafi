<?php

namespace FAFI\FE;

use FAFI\entity\Player\Player;

class PlayerPage implements PageInterface
{
    private Player $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }
}
