<?php

namespace FAFI\entity\Player\Repository;

use FAFI\entity\Player\Player;
use FAFI\exception\FafiException;

class PlayerRepository
{
    private PlayerResource $playerResource;

    public function __construct()
    {
        $this->playerResource = new PlayerResource();
    }


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
     * @return array
     * @throws FafiException
     */
    public function findCollection(PlayerCriteria $criteria): array
    {
        return $this->playerResource->read($criteria);
    }

    public function count(PlayerCriteria $criteria): int
    {
        return $this->playerResource->count($criteria);
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

//    public function delete(Player $player): bool
//    {
//        $criteria = new PlayerCriteria([$player->getId()]);
//        return $this->playerResource->delete($criteria);
//    }

//    public function updateStatus(int $playerId, string $status): bool
//    {
//        return (bool)$this->playerResource->patch($playerId, [PlayerResource::FIELD => $status]);
//    }
}
