<?php

namespace FAFI\entity;

use FAFI\entity\Player\PlayerService;

class FAFI
{
    private PlayerService $playerService;

    public function __construct()
    {
        $this->playerService = new PlayerService();
    }

    public function getPlayerService(): PlayerService
    {
        return $this->playerService;
    }
}
