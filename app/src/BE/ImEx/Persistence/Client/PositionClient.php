<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence\Client;

use FAFI\src\BE\Domain\Position\Position;
use FAFI\src\BE\Domain\Position\PositionService;

class PositionClient implements EntityClientInterface
{
    private PositionService $positionService;

    public function __construct()
    {
        $this->positionService = new PositionService();
    }


    public function create($entity): Position
    {
        return $this->positionService->getPositionRepo()->save($entity);
    }

    public function update($entity): Position
    {
        return $this->positionService->getPositionRepo()->save($entity);
    }
}
