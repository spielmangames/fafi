<?php

namespace FAFI\src\BE\Player;

use FAFI\src\BE\Player\Repository\PlayerRepository;

class PlayerService
{
    private PlayerRepository $playerRepository;

    public function __construct()
    {
        $this->playerRepository = new PlayerRepository();
    }


    public function getPlayerRepo(): PlayerRepository
    {
        return $this->playerRepository;
    }
}
