<?php

namespace FAFI\entity\Player;

use Exception;
use FAFI\entity\Player\Repository\PlayerCriteria;
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

    public function read(PlayersFilter $filter): array
    {
        $criteria = new PlayerCriteria($filter->getPlayerIds());
        $players = $this->playerRepository->findCollection(
            $criteria,
            $filter->getOffset(),
            $filter->getLimit()
        );

        $pagination = new Pagination(
            $filter->getOffset(),
            $filter->getLimit(),
            $this->playerRepository->getCount($criteria)
        );

        return new QueryResponse($players, $pagination);
    }
}
