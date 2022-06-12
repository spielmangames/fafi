<?php

namespace FAFI\src\BE\PlayerAttribute;

use FAFI\src\BE\PlayerAttribute\Repository\PlayerAttributeRepository;

class PlayerAttributeService
{
    private PlayerAttributeRepository $playerAttributeRepository;

    public function __construct()
    {
        $this->playerAttributeRepository = new PlayerAttributeRepository();
    }


    public function getPlayerAttributeRepository(): PlayerAttributeRepository
    {
        return $this->playerAttributeRepository;
    }
}
