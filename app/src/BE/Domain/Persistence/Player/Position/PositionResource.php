<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Player\Position;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Player\Position\Position;
use FAFI\src\BE\Domain\Dto\Player\Position\PositionConstraints;
use FAFI\src\BE\Domain\Dto\Player\Position\PositionData;
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


    public function __construct()
    {
        parent::__construct(new PositionHydrator(), new PositionDataHydrator());
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
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return Position|null
     * @throws FafiException
     */
    public function read(array $conditions): ?Position
    {
        /** @var Position|null $result */
        $result = parent::read($conditions);

        return $result;
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return Position[]
     * @throws FafiException
     */
    public function list(array $conditions = []): array
    {
        /** @var Position[] $result */
        $result = parent::list($conditions);

        return $result;
    }


    /**
     * @param PositionData $entityData
     *
     * @return Position
     * @throws FafiException
     */
    public function create(EntityDataInterface $entityData): Position
    {
        $this->entityValidator::assertEntityType(PositionData::class, $entityData);

        /** @var Position $result */
        $result = parent::create($entityData);

        return $result;
    }

    /**
     * @param PositionData $entityData
     *
     * @return Position
     * @throws FafiException
     */
    public function update(EntityDataInterface $entityData): Position
    {
        $this->entityValidator::assertEntityType(PositionData::class, $entityData);

        /** @var Position $result */
        $result = parent::update($entityData);

        return $result;
    }


    protected function verifyModelPropertiesConstraints(array $data): void
    {
        if (isset($data[self::ID_FIELD])) {
            $field = self::ID_FIELD;
            $this->entityValidator::assertEntityPropertyIdInt($data[$field], $field);
        }

        if (isset($data[self::NAME_FIELD])) {
            $field = self::NAME_FIELD;
            $this->entityValidator::assertEntityPropertyStr($data[$field], $field, PositionConstraints::NAME_MIN, PositionConstraints::NAME_MAX);
        }
    }
}
