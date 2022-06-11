<?php

namespace FAFI\src\BE\Player\Repository;

use FAFI\exception\FafiException;
use FAFI\src\BE\Player\Player;
use FAFI\src\BE\Structure\EntityInterface;
use FAFI\src\BE\Structure\Repository\AbstractResource;
use FAFI\src\BE\Structure\Repository\EntityCriteriaInterface;

class PlayerResource extends AbstractResource
{
    private const TABLE = 'players';
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
    public const REQUIRED_FIELDS = [
        self::SURNAME_FIELD,
        self::FAFI_SURNAME_FIELD,
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


    protected PlayerHydrator $hydrator;

    public function __construct()
    {
        parent::__construct();
        $this->hydrator = new PlayerHydrator();
    }

    protected function getTable(): string
    {
        return self::TABLE;
    }


    /**
     * @param Player $entity
     *
     * @return Player
     * @throws FafiException
     */
    public function create($entity): Player
    {
        /** @var Player $result */
        $result = parent::create($entity);

        return $result;
    }

    protected function verifyConstraintsOnCreate(string $table, EntityInterface $entity, array $data): void
    {
        $this->entityValidator->assertEntityIdAbsent($entity);
        $this->entityValidator->assertEntityMandatoryDataPresent($entity, $data, self::REQUIRED_FIELDS);
        $this->dbValidator->assertResourcePropertyUnique($table, $entity, $data, self::FAFI_SURNAME_FIELD);
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return Player[]|null
     * @throws FafiException
     */
    public function read(array $conditions = []): ?array
    {
        /** @var Player[]|null $result */
        $result = parent::read($conditions);

        return $result;
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return Player|null
     * @throws FafiException
     */
    public function readFirst(array $conditions): ?Player
    {
        /** @var Player|null $result */
        $result = parent::readFirst($conditions);

        return $result;
    }

    /**
     * @param Player $entity
     *
     * @return Player
     * @throws FafiException
     */
    public function update($entity): Player
    {
        /** @var Player $result */
        $result = parent::update($entity);

        return $result;
    }

//    public function patch(int $playerId, array $fieldValues): int
//    {
//        return $this->connection->table(self::TABLE)
//            ->where(self::ID_FIELD, '=', $playerId)
//            ->update($fieldValues);
//    }
//
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
//
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
