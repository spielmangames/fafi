<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence\Client;

use FAFI\src\BE\Domain\Player\PlayerService;

class PlayerClient implements EntityClientInterface
{
    private PlayerService $playerService;

    public function __construct()
    {
        $this->playerService = new PlayerService();
    }


    public function create($entity): int
    {
        return $this->playerService->getPlayerRepo()->save($entity)->getId();
    }

    public function update($entity)
    {
        $this->playerService->getPlayerRepo()->save($entity);
    }
}
