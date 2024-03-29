<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Geo\City;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Geo\City\City;
use FAFI\src\BE\Domain\Dto\Geo\City\CityConstraints;
use FAFI\src\BE\Domain\Dto\Geo\City\CityData;
use FAFI\src\BE\Domain\Persistence\AbstractResource;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;

class CityResource extends AbstractResource
{
    private const TABLE = 'cities';
    private const COLUMNS = [
        self::ID_FIELD,

        self::NAME_FIELD,
        self::COUNTRY_ID_FIELD,
    ];
    private const REQUIRED_FIELDS = [
        self::NAME_FIELD,
        self::COUNTRY_ID_FIELD,
    ];
    private const UNIQUE_FIELDS = [
        self::NAME_FIELD,
    ];


    public const NAME_FIELD = 'name';
    public const COUNTRY_ID_FIELD = 'country_id';


    public function __construct()
    {
        parent::__construct(new CityHydrator(), new CityDataHydrator());
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
     * @return City|null
     * @throws FafiException
     */
    public function read(array $conditions): ?City
    {
        /** @var City|null $result */
        $result = parent::read($conditions);

        return $result;
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return City[]
     * @throws FafiException
     */
    public function list(array $conditions = []): array
    {
        /** @var City[] $result */
        $result = parent::list($conditions);

        return $result;
    }


    /**
     * @param CityData $entityData
     *
     * @return City
     * @throws FafiException
     */
    public function create(EntityDataInterface $entityData): City
    {
        $this->entityValidator::assertEntityType(CityData::class, $entityData);

        /** @var City $result */
        $result = parent::create($entityData);

        return $result;
    }

    /**
     * @param CityData $entityData
     *
     * @return City
     * @throws FafiException
     */
    public function update(EntityDataInterface $entityData): City
    {
        $this->entityValidator::assertEntityType(CityData::class, $entityData);

        /** @var City $result */
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
            $this->entityValidator::assertEntityPropertyStr($data[$field], $field, CityConstraints::NAME_MIN, CityConstraints::NAME_MAX);
        }
        if (isset($data[self::COUNTRY_ID_FIELD])) {
            $field = self::COUNTRY_ID_FIELD;
            $this->entityValidator::assertEntityPropertyIdInt($data[$field], $field);
        }
    }
}
