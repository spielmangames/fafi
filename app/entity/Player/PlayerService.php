<?php

namespace FAFI\entity\Player;

use Exception;
use FAFI\entity\Player\Repository\PlayerRepository;

class PlayerService
{
    private PlayerRepository $playerRepository;


    public function __construct()
    {
        $this->playerRepository = new PlayerRepository();
    }


    /**
     * @param Player $player
     * @return Player
     * @throws Exception
     */
    public function create(Player $player): Player
    {
        return $this->playerRepository->save($player);
    }
}
