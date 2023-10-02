<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Geo\Country;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Geo\Country\Country;
use FAFI\src\BE\Domain\Dto\Geo\Country\CountryData;
use FAFI\src\BE\Domain\Persistence\AbstractResource;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;

class CountryResource extends AbstractResource
{
    private const TABLE = 'countries';
    private const COLUMNS = [
        self::ID_FIELD,

        self::NAME_FIELD,
        self::CONTINENT_FIELD,
    ];
    private const REQUIRED_FIELDS = [
        self::NAME_FIELD,
        self::CONTINENT_FIELD,
    ];
    private const UNIQUE_FIELDS = [
        self::NAME_FIELD,
    ];


    public const NAME_FIELD = 'name';
    public const CONTINENT_FIELD = 'continent';


    public function __construct()
    {
        parent::__construct(new CountryHydrator());
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
     * @param CountryData $entityData
     *
     * @return Country
     * @throws FafiException
     */
    public function create(EntityDataInterface $entityData): Country
    {
        $this->entityValidator::verifyInterface(CountryData::class, $entityData);

        /** @var Country $result */
        $result = parent::create($entityData);

        return $result;
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return Country[]
     * @throws FafiException
     */
    public function list(array $conditions = []): array
    {
        /** @var Country[] $result */
        $result = parent::list($conditions);

        return $result;
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return Country|null
     * @throws FafiException
     */
    public function read(array $conditions): ?Country
    {
        /** @var Country|null $result */
        $result = parent::read($conditions);

        return $result;
    }

    /**
     * @param CountryData $entityData
     *
     * @return Country
     * @throws FafiException
     */
    public function update(EntityDataInterface $entityData): Country
    {
        $this->entityValidator::verifyInterface(CountryData::class, $entityData);

        /** @var Country $result */
        $result = parent::update($entityData);

        return $result;
    }


    protected function verifyModelPropertiesConstraints(array $data): void
    {
        // to implement
    }
}
