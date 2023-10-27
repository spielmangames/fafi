<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Clients;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Player\Position\Position;
use FAFI\src\BE\Domain\Dto\Player\Position\PositionData;
use FAFI\src\BE\Domain\Service\PlayerService;

class PositionClient implements EntityClientInterface
{
    private PlayerService $playerService;

    public function __construct()
    {
        $this->playerService = new PlayerService();
    }


    public function save(EntityDataInterface $entity): Position
    {
        /** @var PositionData $entity */
        return $this->playerService->savePosition($entity);
    }
}
