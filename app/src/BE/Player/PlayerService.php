<?php

namespace FAFI\src\BE\Player;

use FAFI\src\BE\Player\Repository\PlayerRepository;
use FAFI\src\BE\Position\Repository\PositionRepository;

class PlayerService
{
    private PlayerRepository $playerRepository;
    private PositionRepository $positionRepository;

    public function __construct()
    {
        $this->playerRepository = new PlayerRepository();
        $this->positionRepository = new PositionRepository();
    }


    public function getPlayerRepo(): PlayerRepository
    {
        return $this->playerRepository;
    }

    public function getPositionRepo(): PositionRepository
    {
        return $this->positionRepository;
    }
}
