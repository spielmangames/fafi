<?php

namespace FAFI\entity\Player\Repository;

use Exception;
use FAFI\entity\AbstractResource;
use FAFI\entity\Player\Player;
use FAFI\entity\Player\PlayerHydrator;

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


    // profile basic
    public const ID_FIELD = 'id';

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


    private const DEFAULT_READ_LIMIT = 50;


    private PlayerHydrator $hydrator;

    public function __construct()
    {
        parent::__construct();
        $this->hydrator = new PlayerHydrator();
    }


    /**
     * @param Player $player
     * @return Player
     * @throws Exception
     */
    public function create(Player $player): Player
    {
        if ($player->getId()) {
            throw new Exception('"id" must be null for creating Player.');
        }

        $connect = $this->dbConnection->init();

        $playerModel = $this->hydrator->extract($player);

        $query = 'INSERT INTO %s (%s) VALUES (%s);';
        $query = sprintf($query, self::TABLE, $this->getColumns(), $playerModel);

        $result = $connect->query($query);
        if (!$result) {
            echo $connect->error;
        }
        $playerId = 123;

        if (!$playerId) {
            throw new Exception('Player creation failed.');
        }

        $criteria = new PlayerCriteria([$playerId]);
        $result = $this->readFirst($criteria);

        if (!$result) {
            throw new Exception(sprintf('Player (id = %d) is absent in storage.', $playerId));
        }

        $this->dbConnection->close();

        return $result;
    }

//    public function read(PlayerCriteria $criteria, int $offset = 0, int $limit = self::DEFAULT_READ_LIMIT): array
//    {
//        $result = [];
//        foreach ($this->select($criteria, $offset, $limit) as $data) {
//            $result[] = $this->hydrator->hydrate($data);
//        }
//
//        return $result;
//    }

    public function readFirst(PlayerCriteria $criteria): ?Player
    {
        $result = $this->select($criteria, 0, 1)->first();
        return ($result) ? $this->hydrator->hydrate($result) : null;
    }

    public function update(Player $player): Player
    {
        if (!$player->getId()) {
            throw new Exception('ID is required for updating ImportChunk and can not be null.');
        }

//        $this->connect->table(self::TABLE)
//            ->where(self::ID_FIELD, '=', $player->getId())
//            ->update(
//                [
//                    self::IMPORT_STATUS_FIELD => $player->getStatus(),
//                    self::ITEMS_CREATED_FIELD => $player->getCreatedItems(),
//                    self::ITEMS_FAILED_FIELD => $player->getFailedItems(),
//                    self::ITEMS_TOTAL_FIELD => $player->getTotalItems(),
//                ]
//            );

        return $player;
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
//            $this->buildWhere($query, $criteria);
//        }
//
//        return $query->count();
//    }

    private function select(PlayerCriteria $criteria, int $offset, int $limit): Collection
    {
        $query = $this->dbConnection->getConnection()->query()
            ->select('*')
            ->from(self::TABLE)
            ->orderByDesc(self::ID_FIELD);

        if (!$criteria->isEmpty()) {
            $this->buildWhere($query, $criteria);
        }
        $query->offset($offset);
        $query->limit($limit);

        return $query->get();
    }

    private function buildWhere(Builder $query, PlayerCriteria $criteria): void
    {
        if ($criteria->getPlayerIds()) {
            $query->whereIn(self::ID_FIELD, $criteria->getPlayerIds());
        }

        if ($criteria->getEntity()) {
            $query->where(self::ENTITY_FIELD, '=', $criteria->getEntity());
        }

        if ($criteria->getStatuses()) {
            $query->whereIn(self::IMPORT_STATUS_FIELD, $criteria->getStatuses());
        }
    }

    private function getColumns(): string
    {
        return implode(', ', self::COLUMNS);
    }
}
