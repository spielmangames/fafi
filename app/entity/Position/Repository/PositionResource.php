<?php

namespace FAFI\entity\Position\Repository;

use FAFI\entity\Position\Position;
use FAFI\entity\Structure\Repository\AbstractResource;
use FAFI\exception\FafiException;

class PositionResource extends AbstractResource
{
    public const TABLE = 'positions';
    public const COLUMNS = [
        self::ID_FIELD,

        self::NAME_FIELD,
    ];

    public const NAME_FIELD = 'name';


    private PositionHydrator $hydrator;

    public function __construct()
    {
        parent::__construct();
        $this->hydrator = new PositionHydrator();
    }


    /**
     * @param Position $position
     * @return Position
     * @throws FafiException
     */
    public function create(Position $position): Position
    {
        if ($position->getId()) {
            throw new FafiException(sprintf(self::E_ID_PRESENT, Position::ENTITY));
        }

        $data = $this->hydrator->extract($position);
        $id = $this->insertRecord(self::TABLE, $data);

        $criteria = new PositionCriteria([$id]);
        $result = $this->readFirst($criteria);
        if (!$result) {
            throw new FafiException(sprintf(self::E_ENTITY_ABSENT, Position::ENTITY, $id));
        }

        return $result;
    }

    /**
     * @param PositionCriteria $criteria
     * @return Position[]|null
     * @throws FafiException
     */
    public function read(PositionCriteria $criteria): ?array
    {
        $result = [];
        foreach ($this->selectRecords(self::TABLE, $criteria) as $record) {
            $result[] = $this->hydrator->hydrate($record);
        }

        return $result;
    }

    /**
     * @param PositionCriteria $criteria
     * @return Position|null
     * @throws FafiException
     */
    public function readFirst(PositionCriteria $criteria): ?Position
    {
        $result = $this->selectRecords(self::TABLE, $criteria);
        return (!empty($result)) ? $this->hydrator->hydrate($result[0]) : null;
    }

    /**
     * @param Position $position
     * @return Position
     * @throws FafiException
     */
    public function update(Position $position): Position
    {
        if (!$position->getId()) {
            throw new FafiException(self::E_ID_ABSENT, Position::ENTITY);
        }
        $id = $position->getId();

        $data = $this->hydrator->extract($position);
        $this->updateRecord(self::TABLE, $data, new PositionCriteria([$id]));

        $criteria = new PositionCriteria([$id]);
        $result = $this->readFirst($criteria);
        if (!$result) {
            throw new FafiException(sprintf(self::E_ENTITY_ABSENT, Position::ENTITY, $id));
        }

        return $result;
    }
}
