<?php

namespace FAFI\src\BE\Player\Repository;

use FAFI\db\QueryBuilder;
use FAFI\exception\FafiException;
use FAFI\src\BE\Player\Player;
use FAFI\src\BE\Structure\EntityInterface;
use FAFI\src\BE\Structure\Repository\AbstractResource;
use FAFI\src\BE\Structure\Repository\EntityCriteriaInterface;

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


    private PlayerHydrator $hydrator;

    public function __construct()
    {
        parent::__construct();
        $this->hydrator = new PlayerHydrator();
    }


    /**
     * @param Player $entity
     *
     * @return Player
     * @throws FafiException
     */
    public function create(Player $entity): Player
    {
        $data = $this->hydrator->extract($entity);

        $this->verifyConstraintsOnCreate(self::TABLE, $entity, $data);
        $id = $this->queryExecutor->createRecord(self::TABLE, $data);

        $criteria = new Criteria(self::ID_FIELD, QueryBuilder::OPERATOR_IS, [$id]);
        $result = $this->readFirst([$criteria]);
        if (!$result) {
            throw new FafiException(sprintf(FafiException::E_ENTITY_ABSENT, $entity, $id));
        }

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
        $selection = $this->queryExecutor->readRecords(self::TABLE, $conditions);

        $result = [];
        foreach ($selection as $record) {
            $result[] = $this->hydrator->hydrate($record);
        }

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
        $selection = $this->read($conditions);
        return !empty($selection) ? array_shift($selection) : null;
    }

    /**
     * @param Player $entity
     *
     * @return Player
     * @throws FafiException
     */
    public function update(Player $entity): Player
    {
        $this->entityValidator->assertEntityIdPresent($entity);
        $id = $entity->getId();
        $data = $this->hydrator->extract($entity);

        // assert constraints before operation
        $criteria = new Criteria(self::ID_FIELD, QueryBuilder::OPERATOR_IS, [$id]);
        $this->queryExecutor->updateRecord(self::TABLE, $data, [$criteria]);

        $criteria = new Criteria(self::ID_FIELD, QueryBuilder::OPERATOR_IS, [$id]);
        $result = $this->readFirst([$criteria]);
        if (!$result) {
            throw new FafiException(sprintf(FafiException::E_ENTITY_ABSENT, Player::ENTITY, $id));
        }

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
