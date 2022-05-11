<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Persistence\Client;

use FAFI\src\Player\Player;
use FAFI\src\Player\PlayerService;

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
