<?php

namespace FAFI\src\BE\Domain\Player;

use FAFI\src\BE\Domain\Player\Player\Persistence\PlayerRepository;
use FAFI\src\BE\Domain\Player\PlayerAttribute\Persistence\PlayerAttributeRepository;
use FAFI\src\BE\Domain\Player\Position\Persistence\PositionRepository;

class PlayerService
{
    private PositionRepository $positionRepository;
    private PlayerRepository $playerRepository;
    private PlayerAttributeRepository $playerAttributeRepository;

    public function __construct()
    {
        $this->positionRepository = new PositionRepository();
        $this->playerRepository = new PlayerRepository();
        $this->playerAttributeRepository = new PlayerAttributeRepository();
    }


    public function getPositionRepo(): PositionRepository
    {
        return $this->positionRepository;
    }

    public function getPlayerRepo(): PlayerRepository
    {
        return $this->playerRepository;
    }

    public function getPlayerAttributeRepo(): PlayerAttributeRepository
    {
        return $this->playerAttributeRepository;
    }
}
