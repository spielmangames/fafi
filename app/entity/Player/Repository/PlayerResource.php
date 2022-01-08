<?php

namespace FAFI\entity\Player\Repository;

use FAFI\entity\AbstractResource;
use FAFI\entity\Player\Player;
use FAFI\exception\FafiException;

class PlayerResource extends AbstractResource
{
    public const TABLE = 'players';
    public const COLUMNS = [
        self::ID_FIELD,

        self::NAME_FIELD,
        self::PARTICLE_FIELD,
        self::SURNAME_FIELD,
        self::FAFI_SURNAME_FIELD,
//        self::BIRTH_COUNTRY_FIELD,
//        self::BIRTH_CITY_FIELD,
//        self::BIRTH_DATE_FIELD,

        self::HEIGHT_FIELD,
        self::FOOT_FIELD,
        self::INJURE_FACTOR_FIELD,
    ];


    // personal origin
    public const NAME_FIELD = 'name';
    public const PARTICLE_FIELD = 'particle';
    public const SURNAME_FIELD = 'surname';
    public const FAFI_SURNAME_FIELD = 'fafi_surname';
//    public const BIRTH_COUNTRY_FIELD = 'birth_country';
//    public const BIRTH_CITY_FIELD = 'birth_city';
//    public const BIRTH_DATE_FIELD = 'birth_date';

    // skills shape
    public const HEIGHT_FIELD = 'height';
    public const FOOT_FIELD = 'foot';
    public const INJURE_FACTOR_FIELD = 'injure_factor';


    private PlayerHydrator $hydrator;

    public function __construct()
    {
        parent::__construct();
        $this->hydrator = new PlayerHydrator();
    }


    /**
     * @param Player $player
     * @return Player
     * @throws FafiException
     */
    public function create(Player $player): Player
    {
        if ($player->getId()) {
            throw new FafiException('"id" must be null for creating Player.');
        }

        $playerData = $this->hydrator->extract($player);
        $id = $this->insertRecord(self::TABLE, $playerData);

        $criteria = new PlayerCriteria([$id]);
        $result = $this->readFirst($criteria);
        if (!$result) {
            throw new FafiException(sprintf('Player (id = %d) is absent in storage.', $id));
        }

        return $result;
    }

    /**
     * @param PlayerCriteria $criteria
     * @return array|null
     * @throws FafiException
     */
    public function read(PlayerCriteria $criteria): ?array
    {
        $result = [];
        foreach ($this->selectRecords(self::TABLE, $criteria) as $record) {
            $result[] = $this->hydrator->hydrate($record);
        }

        return $result;
    }

    /**
     * @param PlayerCriteria $criteria
     * @return Player|null
     * @throws FafiException
     */
    public function readFirst(PlayerCriteria $criteria): ?Player
    {
        $result = $this->selectRecords(self::TABLE, $criteria);
        return (!empty($result)) ? $this->hydrator->hydrate($result[0]) : null;
    }

    /**
     * @param Player $player
     * @return Player
     * @throws FafiException
     */
    public function update(Player $player): Player
    {
        if (!$player->getId()) {
            throw new FafiException('ID is required for updating Player and can not be null.');
        }
        $id = $player->getId();

        $playerData = $this->hydrator->extract($player);
        $this->updateRecord(self::TABLE, $playerData, new PlayerCriteria([$id]));

        $criteria = new PlayerCriteria([$id]);
        $result = $this->readFirst($criteria);
        if (!$result) {
            throw new FafiException(sprintf('Player (id = %d) is absent in storage.', $id));
        }

        return $result;
    }

//    public function patch(int $playerId, array $fieldValues): int
//    {
//        return $this->connection->table(self::TABLE)
//            ->where(self::ID_FIELD, '=', $playerId)
//            ->update($fieldValues);
//    }

//    public function delete(PlayerCriteria $criteria): bool
//    {
//        if ($criteria->isEmpty()) {
//            throw new Exception('Criteria for delete query is not specified.');
//        }
//
//        $query = $this->connection->table(self::TABLE);
//        $this->buildWhere($query, $criteria);
//
//        return (bool)$query->delete();
//    }

//    public function count(PlayerCriteria $criteria): int
//    {
//        $query = $this->connection->table(self::TABLE);
//
//        if (!$criteria->isEmpty()) {
//            $this->formWhere($criteria);
//        }
//
//        return $query->count();
//    }
}
