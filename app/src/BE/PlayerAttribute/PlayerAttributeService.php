<?php

namespace FAFI\src\BE\PlayerAttribute;

use FAFI\exception\FafiException;
use FAFI\src\BE\PlayerAttribute\Repository\PlayerAttributeCriteria;
use FAFI\src\BE\PlayerAttribute\Repository\PlayerAttributeRepository;
use FAFI\src\BE\PlayerAttribute\Repository\PlayerAttributesFilter;

class PlayerAttributeService
{
    private PlayerAttributeRepository $playerAttributeRepository;

    public function __construct()
    {
        $this->playerAttributeRepository = new PlayerAttributeRepository();
    }


    /**
     * @param PlayerAttribute $playerAttribute
     *
     * @return PlayerAttribute
     * @throws FafiException
     */
    public function create(PlayerAttribute $playerAttribute): PlayerAttribute
    {
        return $this->playerAttributeRepository->save($playerAttribute);
    }

    /**
     * @param PlayerAttributesFilter $filter
     *
     * @return PlayerAttribute[]
     * @throws FafiException
     */
    public function read(PlayerAttributesFilter $filter): array
    {
        $criteria = new PlayerAttributeCriteria($filter->getPositionIds());
        return $this->playerAttributeRepository->findCollection($criteria);
    }

    public function update()
    {
        // TO BE IMPLEMENTED
    }

    public function delete()
    {
        // TO BE IMPLEMENTED
    }
}
