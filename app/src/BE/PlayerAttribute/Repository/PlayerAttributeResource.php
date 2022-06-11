<?php

namespace FAFI\src\BE\PlayerAttribute\Repository;

use FAFI\db\QueryBuilder;
use FAFI\exception\FafiException;
use FAFI\src\BE\Player\Repository\Criteria;
use FAFI\src\BE\PlayerAttribute\PlayerAttribute;
use FAFI\src\BE\Structure\EntityInterface;
use FAFI\src\BE\Structure\Repository\AbstractResource;
use FAFI\src\BE\Structure\Repository\EntityCriteriaInterface;

class PlayerAttributeResource extends AbstractResource
{
    public const TABLE = 'players_positions_assocs';
    public const COLUMNS = [
        self::ID_FIELD,

        self::PLAYER_ID_FIELD,
        self::POSITION_ID_FIELD,

        self::ATT_MIN_FIELD,
        self::ATT_MAX_FIELD,
        self::DEF_MIN_FIELD,
        self::DEF_MAX_FIELD,
    ];
    public const REQUIRED_FIELDS = [];


    public const PLAYER_ID_FIELD = 'player_id';
    public const POSITION_ID_FIELD = 'position_id';

    public const ATT_MIN_FIELD = 'att_min';
    public const ATT_MAX_FIELD = 'att_max';
    public const DEF_MIN_FIELD = 'def_min';
    public const DEF_MAX_FIELD = 'def_max';


    protected PlayerAttributeHydrator $hydrator;

    public function __construct()
    {
        parent::__construct();
        $this->hydrator = new PlayerAttributeHydrator();
    }


    /**
     * @param PlayerAttribute $entity
     *
     * @return PlayerAttribute
     * @throws FafiException
     */
    public function create(PlayerAttribute $entity): PlayerAttribute
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
        // to implement
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return PlayerAttribute[]|null
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
     * @return PlayerAttribute|null
     * @throws FafiException
     */
    public function readFirst(array $conditions): ?PlayerAttribute
    {
        $selection = $this->read($conditions);
        return !empty($selection) ? array_shift($selection) : null;
    }

    /**
     * @param PlayerAttribute $entity
     *
     * @return PlayerAttribute
     * @throws FafiException
     */
    public function update(PlayerAttribute $entity): PlayerAttribute
    {
        if (!$entity->getId()) {
            throw new FafiException(FafiException::E_ID_ABSENT, PlayerAttribute::ENTITY);
        }
        $id = $entity->getId();

        $data = $this->hydrator->extract($entity);
        $this->queryExecutor->updateRecord(self::TABLE, $data, new PlayerAttributeCriteria([$id]));

        $criteria = new PlayerAttributeCriteria([$id]);
        $result = $this->readFirst($criteria);
        if (!$result) {
            throw new FafiException(sprintf(FafiException::E_ENTITY_ABSENT, PlayerAttribute::ENTITY, $id));
        }

        return $result;
    }
}
