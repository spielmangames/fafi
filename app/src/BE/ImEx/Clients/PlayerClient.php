<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Clients;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Player\Player\Player;
use FAFI\src\BE\Domain\Dto\Player\Player\PlayerData;
use FAFI\src\BE\Domain\Service\PlayerService;

class PlayerClient implements EntityClientInterface
{
    private PlayerService $playerService;

    public function __construct()
    {
        $this->playerService = new PlayerService();
    }


    public function save(EntityDataInterface $entity): Player
    {
        /** @var PlayerData $entity */
        return $this->playerService->savePlayer($entity);
    }
}
