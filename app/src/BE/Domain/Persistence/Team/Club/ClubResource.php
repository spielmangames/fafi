<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Team\Club;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Team\Club\Club;
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
        self::COUNTRY_ID_FIELD,
        self::FOUNDED_FIELD,
    ];
    private const REQUIRED_FIELDS = [
        self::NAME_FIELD,
    ];
    private const UNIQUE_FIELDS = [
        self::NAME_FIELD,
    ];


    public const NAME_FIELD = 'name';
    public const FAFI_NAME_FIELD = 'fafi_name';
    public const CITY_ID_FIELD = 'city_id';
    public const COUNTRY_ID_FIELD = 'country_id';
    public const FOUNDED_FIELD = 'founded';


    public function __construct()
    {
        parent::__construct(new ClubHydrator());
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
     * @param ClubData $entityData
     *
     * @return Club
     * @throws FafiException
     */
    public function create(EntityDataInterface $entityData): Club
    {
        $this->entityValidator::verifyInterface(ClubData::class, $entityData);

        /** @var Club $result */
        $result = parent::create($entityData);

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
     * @param ClubData $entityData
     *
     * @return Club
     * @throws FafiException
     */
    public function update(EntityDataInterface $entityData): Club
    {
        $this->entityValidator::verifyInterface(ClubData::class, $entityData);

        /** @var Club $result */
        $result = parent::update($entityData);

        return $result;
    }


    protected function verifyModelPropertiesConstraints(array $data): void
    {
        // to implement
    }
}
