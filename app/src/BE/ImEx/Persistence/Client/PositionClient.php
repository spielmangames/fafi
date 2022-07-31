<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence\Client;

use FAFI\src\BE\Domain\Dto\Player\Position\Position;
use FAFI\src\BE\Domain\Service\PlayerService;

class PositionClient implements EntityClientInterface
{
    private PlayerService $playerService;

    public function __construct()
    {
        $this->playerService = new PlayerService();
    }


    public function create($entity): Position
    {
        return $this->playerService->savePosition($entity);
    }

    public function update($entity): Position
    {
        return $this->playerService->savePosition($entity);
    }
}
