<?php

namespace FAFI\entity\Player\Repository;

use Exception;
use FAFI\entity\Player\Player;

class PlayerRepository
{
    private PlayerResource $playerResource;

    public function __construct()
    {
        $this->playerResource = new PlayerResource();
    }


    public function findById(int $id): ?Player
    {
        $criteria = new PlayerCriteria([$id]);
        return $this->playerResource->readFirst($criteria);
    }

//    public function findCollection(PlayerCriteria $criteria, int $offset, int $limit): array
//    {
//        return $this->playerResource->read($criteria, $offset, $limit);
//    }

//    public function count(PlayerCriteria $criteria): int
//    {
//        return $this->playerResource->count($criteria);
//    }

    /**
     * @param Player $player
     * @return Player
     * @throws Exception
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
