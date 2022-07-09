<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence\Client;

use FAFI\src\BE\Domain\Position\PositionService;

class PositionClient implements EntityClientInterface
{
    private PositionService $positionService;

    public function __construct()
    {
        $this->positionService = new PositionService();
    }


    public function create($entity): int
    {
        return $this->positionService->getPositionRepo()->save($entity)->getId();
    }

    public function update($entity)
    {
        $this->positionService->getPositionRepo()->save($entity);
    }
}
