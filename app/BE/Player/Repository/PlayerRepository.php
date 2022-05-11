<?php

namespace FAFI\BE\Player\Repository;

use FAFI\BE\Player\Player;
use FAFI\exception\FafiException;

class PlayerRepository
{
    private PlayerResource $playerResource;

    public function __construct()
    {
        $this->playerResource = new PlayerResource();
    }


//    public function count(PlayerCriteria $criteria): int
//    {
//        return $this->playerResource->count($criteria);
//    }

//    public function delete(Player $player): bool
//    {
//        $criteria = new PlayerCriteria([$player->getId()]);
//        return $this->playerResource->delete($criteria);
//    }

    /**
     * @param int $id
     * @return Player|null
     * @throws FafiException
     */
    public function findById(int $id): ?Player
    {
        $criteria = new PlayerCriteria([$id]);
        return $this->playerResource->readFirst($criteria);
    }

    /**
     * @param PlayerCriteria $criteria
     * @return Player[]
     * @throws FafiException
     */
    public function findCollection(PlayerCriteria $criteria): array
    {
        return $this->playerResource->read($criteria);
    }

    /**
     * @param Player $player
     * @return Player
     * @throws FafiException
     */
    public function save(Player $player): Player
    {
        return $player->getId() ? $this->playerResource->update($player) : $this->playerResource->create($player);
    }

//    public function updateFoot(int $playerId, string $foot): bool
//    {
//        return (bool)$this->playerResource->patch($playerId, [PlayerResource::FOOT_FIELD => $foot]);
//    }
}
