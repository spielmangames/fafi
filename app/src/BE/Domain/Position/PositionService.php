<?php

namespace FAFI\src\BE\Domain\Position;

use FAFI\src\BE\Domain\Position\Repository\PositionRepository;

class PositionService
{
    private PositionRepository $positionRepository;

    public function __construct()
    {
        $this->positionRepository = new PositionRepository();
    }


    public function getPositionRepo(): PositionRepository
    {
        return $this->positionRepository;
    }
}
