<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence\Client;

use FAFI\src\BE\Position\PositionService;

class PositionClient implements EntityClientInterface
{
    private PositionService $positionService;

    public function __construct()
    {
        $this->positionService = new PositionService();
    }


    public function create($entity)
    {
        $this->positionService->getPositionRepo()->save($entity);
    }

    public function update($entity)
    {
        $this->positionService->getPositionRepo()->save($entity);
    }
}
