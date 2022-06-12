<?php

namespace FAFI\src\BE\Position;

use FAFI\src\BE\Position\Repository\PositionRepository;

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
