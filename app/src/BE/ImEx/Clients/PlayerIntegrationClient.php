<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Clients;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Player\Integration\PlayerIntegration;
use FAFI\src\BE\Domain\Dto\Player\Integration\PlayerIntegrationData;
use FAFI\src\BE\Domain\Service\PlayerService;

class PlayerIntegrationClient implements EntityClientInterface
{
    private PlayerService $playerService;

    public function __construct()
    {
        $this->playerService = new PlayerService();
    }


    public function save(EntityDataInterface $entity): PlayerIntegration
    {
        /** @var PlayerIntegrationData $entity */
        return $this->playerService->savePlayerIntegration($entity);
    }
}
