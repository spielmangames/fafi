<?php

namespace FAFI\src\BE\Position\Repository;

use FAFI\exception\FafiException;
use FAFI\src\BE\Position\Position;
use FAFI\src\BE\Structure\EntityInterface;
use FAFI\src\BE\Structure\Repository\AbstractResource;
use FAFI\src\BE\Structure\Repository\EntityCriteriaInterface;

class PositionResource extends AbstractResource
{
    private const TABLE = 'positions';
    public const COLUMNS = [
        self::ID_FIELD,

        self::NAME_FIELD,
    ];
    public const REQUIRED_FIELDS = [
        self::NAME_FIELD,
    ];


    public const NAME_FIELD = 'name';


    protected PositionHydrator $hydrator;

    public function __construct()
    {
        parent::__construct();
        $this->hydrator = new PositionHydrator();
    }

    protected function getTable(): string
    {
        return self::TABLE;
    }


    /**
     * @param Position $entity
     *
     * @return Position
     * @throws FafiException
     */
    public function create($entity): Position
    {
        /** @var Position $result */
        $result = parent::create($entity);

        return $result;
    }

    protected function verifyConstraintsOnCreate(string $table, EntityInterface $entity, array $data): void
    {
        // to implement
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return Position[]|null
     * @throws FafiException
     */
    public function read(array $conditions = []): ?array
    {
        /** @var Position[]|null $result */
        $result = parent::read($conditions);

        return $result;
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return Position|null
     * @throws FafiException
     */
    public function readFirst(array $conditions): ?Position
    {
        /** @var Position|null $result */
        $result = parent::readFirst($conditions);

        return $result;
    }

    /**
     * @param Position $entity
     *
     * @return Position
     * @throws FafiException
     */
    public function update($entity): Position
    {
        /** @var Position $result */
        $result = parent::update($entity);

        return $result;
    }
}
