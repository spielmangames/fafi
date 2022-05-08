<?php

namespace FAFI\entity\Player;

use FAFI\entity\Player\Repository\PlayerCriteria;
use FAFI\entity\Player\Repository\PlayerRepository;
use FAFI\entity\Player\Repository\PlayersFilter;
use FAFI\exception\FafiException;

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
