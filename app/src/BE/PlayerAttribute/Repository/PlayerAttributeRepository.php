<?php

namespace FAFI\src\BE\PlayerAttribute\Repository;

use FAFI\exception\FafiException;
use FAFI\src\BE\PlayerAttribute\PlayerAttribute;

class PlayerAttributeRepository
{
    private PlayerAttributeResource $playerAttributeResource;

    public function __construct()
    {
        $this->playerAttributeResource = new PlayerAttributeResource();
    }


    /**
     * @param int $id
     *
     * @return PlayerAttribute|null
     * @throws FafiException
     */
    public function findById(int $id): ?PlayerAttribute
    {
        $criteria = new PlayerAttributeCriteria([$id]);
        return $this->playerAttributeResource->readFirst($criteria);
    }

    /**
     * @param PlayerAttributeCriteria $criteria
     *
     * @return PlayerAttribute[]
     * @throws FafiException
     */
    public function findCollection(PlayerAttributeCriteria $criteria): array
    {
        return $this->playerAttributeResource->read($criteria);
    }

    /**
     * @param PlayerAttribute $playerAttribute
     *
     * @return PlayerAttribute
     * @throws FafiException
     */
    public function save(PlayerAttribute $playerAttribute): PlayerAttribute
    {
        return $playerAttribute->getId() ? $this->playerAttributeResource->update($playerAttribute) : $this->playerAttributeResource->create($playerAttribute);
    }
}
