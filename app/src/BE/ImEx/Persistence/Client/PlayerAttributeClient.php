<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence\Client;

use FAFI\src\BE\Domain\Player\PlayerAttribute\PlayerAttribute;
use FAFI\src\BE\Domain\Player\PlayerService;

class PlayerAttributeClient implements EntityClientInterface
{
    private PlayerService $playerService;

    public function __construct()
    {
        $this->playerService = new PlayerService();
    }


    public function create($entity): PlayerAttribute
    {
        return $this->playerService->getPlayerAttributeRepo()->save($entity);
    }

    public function update($entity): PlayerAttribute
    {
        return $this->playerService->getPlayerAttributeRepo()->save($entity);
    }
}
