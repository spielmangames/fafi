<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Player\Position;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\Player\Position\Position;
use FAFI\src\BE\Domain\Persistence\AbstractResource;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;

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
     * @param Position $entityData
     *
     * @return Position
     * @throws FafiException
     */
    public function create($entityData): Position
    {
        /** @var Position $result */
        $result = parent::create($entityData);

        return $result;
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
     * @param Position $entityData
     *
     * @return Position
     * @throws FafiException
     */
    public function update($entityData): Position
    {
        /** @var Position $result */
        $result = parent::update($entityData);

        return $result;
    }


    protected function verifyModelPropertiesConstraints(array $data): void
    {
        // to implement
    }
}
