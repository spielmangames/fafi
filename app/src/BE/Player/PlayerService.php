<?php

namespace FAFI\src\BE\Player;

use FAFI\exception\FafiException;
use FAFI\src\BE\Player\Repository\PlayerCriteria;
use FAFI\src\BE\Player\Repository\PlayerRepository;
use FAFI\src\BE\Player\Repository\PlayersFilter;

class PlayerService
{
    private PlayerRepository $playerRepository;

    public function __construct()
    {
        $this->playerRepository = new PlayerRepository();
    }


    /**
     * @param Player $player
     *
     * @return Player
     * @throws FafiException
     */
    public function createPlayer(Player $player): Player
    {
        return $this->playerRepository->save($player);
    }

    /**
     * @param PlayersFilter $filter
     *
     * @return Player[]
     * @throws FafiException
     */
    public function readPlayers(PlayersFilter $filter): array
    {
        $criteria = new PlayerCriteria($filter->getPlayerIds());
        return $this->playerRepository->findCollection($criteria);
    }

    public function updatePlayers()
    {
        // TO BE IMPLEMENTED
    }

    public function deletePlayers()
    {
        // TO BE IMPLEMENTED
    }
}
