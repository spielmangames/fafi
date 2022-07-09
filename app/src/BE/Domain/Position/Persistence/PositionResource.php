<?php

namespace FAFI\src\BE\Domain\Position\Persistence;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Position\Position;
use FAFI\src\BE\Structure\Repository\AbstractResource;
use FAFI\src\BE\Structure\Repository\EntityCriteriaInterface;

class PositionResource extends AbstractResource
{
    private const TABLE = 'positions';
    private const COLUMNS = [
        self::ID_FIELD,

        self::NAME_FIELD,
    ];
    private const REQUIRED_FIELDS = [
        self::NAME_FIELD,
    ];
    private const UNIQUE_FIELDS = [
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

    protected function getRequiredFields(): array
    {
        return self::REQUIRED_FIELDS;
    }

    protected function getUniqueFields(): array
    {
        return self::UNIQUE_FIELDS;
    }


    /**
     * @param \FAFI\src\BE\Domain\Position\Position $entity
     *
     * @return \FAFI\src\BE\Domain\Position\Position
     * @throws FafiException
     */
    public function create($entity): Position
    {
        /** @var Position $result */
        $result = parent::create($entity);

        return $result;
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return \FAFI\src\BE\Domain\Position\Position[]|null
     * @throws FafiException
     */
    public function read(array $conditions = []): ?array
    {
        /** @var \FAFI\src\BE\Domain\Position\Position[]|null $result */
        $result = parent::read($conditions);

        return $result;
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return \FAFI\src\BE\Domain\Position\Position|null
     * @throws FafiException
     */
    public function readFirst(array $conditions): ?Position
    {
        /** @var \FAFI\src\BE\Domain\Position\Position|null $result */
        $result = parent::readFirst($conditions);

        return $result;
    }

    /**
     * @param Position $entity
     *
     * @return \FAFI\src\BE\Domain\Position\Position
     * @throws FafiException
     */
    public function update($entity): Position
    {
        /** @var \FAFI\src\BE\Domain\Position\Position $result */
        $result = parent::update($entity);

        return $result;
    }


    protected function verifyModelPropertiesConstraints(array $data): void
    {
        // to implement
    }
}
