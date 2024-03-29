<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Team\Club;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Team\Club\Club;
use FAFI\src\BE\Domain\Dto\Team\Club\ClubConstraints;
use FAFI\src\BE\Domain\Dto\Team\Club\ClubData;
use FAFI\src\BE\Domain\Persistence\AbstractResource;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;

class ClubResource extends AbstractResource
{
    private const TABLE = 'clubs';
    private const COLUMNS = [
        self::ID_FIELD,

        self::NAME_FIELD,
        self::FAFI_NAME_FIELD,

        self::CITY_ID_FIELD,
        self::FOUNDED_FIELD,
    ];
    private const REQUIRED_FIELDS = [
        self::NAME_FIELD,
        self::CITY_ID_FIELD,
    ];
    private const UNIQUE_FIELDS = [
        self::NAME_FIELD,
        self::FAFI_NAME_FIELD,
    ];


    public const NAME_FIELD = 'name';
    public const FAFI_NAME_FIELD = 'fafi_name';

    public const CITY_ID_FIELD = 'city_id';
    public const FOUNDED_FIELD = 'founded';


    public function __construct()
    {
        parent::__construct(new ClubHydrator(), new ClubDataHydrator());
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
     * @return Club|null
     * @throws FafiException
     */
    public function read(array $conditions): ?Club
    {
        /** @var Club|null $result */
        $result = parent::read($conditions);

        return $result;
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return Club[]
     * @throws FafiException
     */
    public function list(array $conditions = []): array
    {
        /** @var Club[] $result */
        $result = parent::list($conditions);

        return $result;
    }


    /**
     * @param ClubData $entityData
     *
     * @return Club
     * @throws FafiException
     */
    public function create(EntityDataInterface $entityData): Club
    {
        $this->entityValidator::assertEntityType(ClubData::class, $entityData);

        /** @var Club $result */
        $result = parent::create($entityData);

        return $result;
    }

    /**
     * @param ClubData $entityData
     *
     * @return Club
     * @throws FafiException
     */
    public function update(EntityDataInterface $entityData): Club
    {
        $this->entityValidator::assertEntityType(ClubData::class, $entityData);

        /** @var Club $result */
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
            $this->entityValidator::assertEntityPropertyStr($data[$field], $field, ClubConstraints::NAME_MIN, ClubConstraints::NAME_MAX);
        }
        if (isset($data[self::FAFI_NAME_FIELD])) {
            $field = self::FAFI_NAME_FIELD;
            $this->entityValidator::assertEntityPropertyStr($data[$field], $field, ClubConstraints::FAFI_NAME_MIN, ClubConstraints::FAFI_NAME_MAX);
        }

        if (isset($data[self::CITY_ID_FIELD])) {
            $field = self::CITY_ID_FIELD;
            $this->entityValidator::assertEntityPropertyIdInt($data[$field], $field);
        }
        if (isset($data[self::FOUNDED_FIELD])) {
            $field = self::FOUNDED_FIELD;
            $this->entityValidator::assertEntityPropertyInt($data[$field], $field, ClubConstraints::FOUNDED_MIN, ClubConstraints::FOUNDED_MAX);
        }
    }
}
