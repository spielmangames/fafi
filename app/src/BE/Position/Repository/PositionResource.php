<?php

namespace FAFI\src\BE\Position\Repository;

use FAFI\exception\FafiException;
use FAFI\src\BE\Position\Position;
use FAFI\src\BE\Structure\Repository\AbstractResource;

class PositionResource extends AbstractResource
{
    public const TABLE = 'positions';
    public const COLUMNS = [
        self::ID_FIELD,

        self::NAME_FIELD,
    ];
    public const REQUIRED_FIELDS = [
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
     * @param Position $entity
     *
     * @return Position
     * @throws FafiException
     */
    public function create(Position $entity): Position
    {
        if ($entity->getId()) {
            throw new FafiException(sprintf(FafiException::E_ID_PRESENT, Position::ENTITY));
        }

        $data = $this->hydrator->extract($entity);
        $this->entityValidator->assertEntityMandatoryDataPresent(Position::ENTITY, $data, self::REQUIRED_FIELDS);
        $id = $this->queryExecutor->createRecord(self::TABLE, $data);

        $criteria = new PositionCriteria([$id]);
        $result = $this->readFirst($criteria);
        if (!$result) {
            throw new FafiException(sprintf(FafiException::E_ENTITY_ABSENT, Position::ENTITY, $id));
        }

        return $result;
    }

    /**
     * @param PositionCriteria $criteria
     *
     * @return Position[]|null
     * @throws FafiException
     */
    public function read(PositionCriteria $criteria): ?array
    {
        $result = [];
        foreach ($this->queryExecutor->readRecords(self::TABLE, $criteria) as $record) {
            $result[] = $this->hydrator->hydrate($record);
        }

        return $result;
    }

    /**
     * @param PositionCriteria $criteria
     *
     * @return Position|null
     * @throws FafiException
     */
    public function readFirst(PositionCriteria $criteria): ?Position
    {
        $result = $this->queryExecutor->readRecords(self::TABLE, $criteria);
        return (!empty($result)) ? $this->hydrator->hydrate($result[0]) : null;
    }

    /**
     * @param Position $entity
     *
     * @return Position
     * @throws FafiException
     */
    public function update(Position $entity): Position
    {
        if (!$entity->getId()) {
            throw new FafiException(FafiException::E_ID_ABSENT, Position::ENTITY);
        }
        $id = $entity->getId();

        $data = $this->hydrator->extract($entity);
        $this->queryExecutor->updateRecord(self::TABLE, $data, new PositionCriteria([$id]));

        $criteria = new PositionCriteria([$id]);
        $result = $this->readFirst($criteria);
        if (!$result) {
            throw new FafiException(sprintf(FafiException::E_ENTITY_ABSENT, Position::ENTITY, $id));
        }

        return $result;
    }
}
