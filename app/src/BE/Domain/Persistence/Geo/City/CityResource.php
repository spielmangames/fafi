<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Geo\City;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Geo\City\City;
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
        parent::__construct(new CityHydrator());
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
     * @param CityData $entityData
     *
     * @return City
     * @throws FafiException
     */
    public function create(EntityDataInterface $entityData): City
    {
        $this->verifyInterface(CityData::class, $entityData);

        /** @var City $result */
        $result = parent::create($entityData);

        return $result;
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return City[]|null
     * @throws FafiException
     */
    public function read(array $conditions = []): ?array
    {
        /** @var City[]|null $result */
        $result = parent::read($conditions);

        return $result;
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return City|null
     * @throws FafiException
     */
    public function readFirst(array $conditions): ?City
    {
        /** @var City|null $result */
        $result = parent::readFirst($conditions);

        return $result;
    }

    /**
     * @param CityData $entityData
     *
     * @return City
     * @throws FafiException
     */
    public function update($entityData): City
    {
        /** @var City $result */
        $result = parent::update($entityData);

        return $result;
    }


    protected function verifyModelPropertiesConstraints(array $data): void
    {
        // to implement
    }
}
