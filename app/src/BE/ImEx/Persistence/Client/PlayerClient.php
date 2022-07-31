<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence\Client;

use FAFI\src\BE\Domain\Dto\Player\Player\Player;
use FAFI\src\BE\Domain\Service\PlayerService;

class PlayerClient implements EntityClientInterface
{
    private PlayerService $playerService;

    public function __construct()
    {
        $this->playerService = new PlayerService();
    }


    public function create($entity): Player
    {
        return $this->playerService->savePlayer($entity);
    }

    public function update($entity): Player
    {
        return $this->playerService->savePlayer($entity);
    }
}
