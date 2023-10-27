<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Clients;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Player\PlayerAttribute\PlayerAttribute;
use FAFI\src\BE\Domain\Dto\Player\PlayerAttribute\PlayerAttributeData;
use FAFI\src\BE\Domain\Service\PlayerService;

class PlayerAttributeClient implements EntityClientInterface
{
    private PlayerService $playerService;

    public function __construct()
    {
        $this->playerService = new PlayerService();
    }


    public function save(EntityDataInterface $entity): PlayerAttribute
    {
        /** @var PlayerAttributeData $entity */
        return $this->playerService->savePlayerAttribute($entity);
    }
}
