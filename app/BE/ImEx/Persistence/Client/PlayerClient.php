<?php

declare(strict_types=1);

namespace FAFI\BE\ImEx\Persistence\Client;

use FAFI\BE\Player\Player;
use FAFI\BE\Player\PlayerService;

class PlayerClient implements EntityClientInterface
{
    private PlayerService $playerService;

    public function __construct()
    {
        $this->playerService = new PlayerService();
    }


    public function create($entity)
    {
        $this->playerService->createPlayer($entity);
    }

    public function update($entity)
    {
        $this->playerService->updatePlayers([$entity]);
    }
}
