<?php

namespace FAFI\src\BE\Player\Repository;

use FAFI\db\Query\QuerySyntax;
use FAFI\exception\FafiException;
use FAFI\src\BE\Player\Player;
use FAFI\src\BE\Structure\Repository\AbstractResource;
use FAFI\src\BE\Structure\Repository\EntityCriteriaInterface;

class PlayerRepository
{
    private PlayerResource $playerResource;

    public function __construct()
    {
        $this->playerResource = new PlayerResource();
    }


    /**
     * @param int $id
     *
     * @return Player|null
     * @throws FafiException
     */
    public function findById(int $id): ?Player
    {
        $criteria = new Criteria(AbstractResource::ID_FIELD, QuerySyntax::OPERATOR_IS, [$id]);
        return $this->playerResource->readFirst([$criteria]);
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return Player[]
     * @throws FafiException
     */
    public function findCollection(array $conditions = []): array
    {
        return $this->playerResource->read($conditions);
    }

    /**
     * @param Player $player
     *
     * @return Player
     * @throws FafiException
     */
    public function save(Player $player): Player
    {
        return $player->getId() ? $this->playerResource->update($player) : $this->playerResource->create($player);
    }

    /**
     * @param int $id
     *
     * @return void
     * @throws FafiException
     */
    public function deleteById(int $id): void
    {
        $criteria = new Criteria(AbstractResource::ID_FIELD, QuerySyntax::OPERATOR_IS, [$id]);
        $this->playerResource->delete([$criteria]);
    }


//    public function updateFoot(int $playerId, string $foot): bool
//    {
//        return (bool)$this->playerResource->patch($playerId, [PlayerResource::FOOT_FIELD => $foot]);
//    }
//
//    public function count(PlayerCriteria $criteria): int
//    {
//        return $this->playerResource->count($criteria);
//    }
}
