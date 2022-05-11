<?php

namespace FAFI\src\BE\PlayerAttribute\Repository;

use FAFI\exception\FafiException;
use FAFI\src\BE\PlayerAttribute\PlayerAttribute;
use FAFI\src\BE\Structure\Repository\AbstractResource;

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

    public const PLAYER_ID_FIELD = 'player_id';
    public const POSITION_ID_FIELD = 'position_id';

    public const ATT_MIN_FIELD = 'att_min';
    public const ATT_MAX_FIELD = 'att_max';
    public const DEF_MIN_FIELD = 'def_min';
    public const DEF_MAX_FIELD = 'def_max';


    private PlayerAttributeHydrator $hydrator;

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
        if ($entity->getId()) {
            throw new FafiException(sprintf(self::E_ID_PRESENT, PlayerAttribute::ENTITY));
        }

        $data = $this->hydrator->extract($entity);
        $id = $this->insertRecord(self::TABLE, $data);

        $criteria = new PlayerAttributeCriteria([$id]);
        $result = $this->readFirst($criteria);
        if (!$result) {
            throw new FafiException(sprintf(self::E_ENTITY_ABSENT, PlayerAttribute::ENTITY, $id));
        }

        return $result;
    }

    /**
     * @param PlayerAttributeCriteria $criteria
     *
     * @return PlayerAttribute[]|null
     * @throws FafiException
     */
    public function read(PlayerAttributeCriteria $criteria): ?array
    {
        $result = [];
        foreach ($this->selectRecords(self::TABLE, $criteria) as $record) {
            $result[] = $this->hydrator->hydrate($record);
        }

        return $result;
    }

    /**
     * @param PlayerAttributeCriteria $criteria
     *
     * @return PlayerAttribute|null
     * @throws FafiException
     */
    public function readFirst(PlayerAttributeCriteria $criteria): ?PlayerAttribute
    {
        $result = $this->selectRecords(self::TABLE, $criteria);
        return (!empty($result)) ? $this->hydrator->hydrate($result[0]) : null;
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
            throw new FafiException(self::E_ID_ABSENT, PlayerAttribute::ENTITY);
        }
        $id = $entity->getId();

        $data = $this->hydrator->extract($entity);
        $this->updateRecord(self::TABLE, $data, new PlayerAttributeCriteria([$id]));

        $criteria = new PlayerAttributeCriteria([$id]);
        $result = $this->readFirst($criteria);
        if (!$result) {
            throw new FafiException(sprintf(self::E_ENTITY_ABSENT, PlayerAttribute::ENTITY, $id));
        }

        return $result;
    }
}
