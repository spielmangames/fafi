<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Geo\City;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\Geo\City\City;
use FAFI\src\BE\Domain\Persistence\AbstractResource;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;

class CityResource extends AbstractResource
{
    private const TABLE = 'cities';
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


    protected CityHydrator $hydrator;

    public function __construct()
    {
        parent::__construct();
        $this->hydrator = new CityHydrator();
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
     * @param City $entity
     *
     * @return City
     * @throws FafiException
     */
    public function create($entity): City
    {
        /** @var City $result */
        $result = parent::create($entity);

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
     * @param City $entity
     *
     * @return City
     * @throws FafiException
     */
    public function update($entity): City
    {
        /** @var City $result */
        $result = parent::update($entity);

        return $result;
    }


    protected function verifyModelPropertiesConstraints(array $data): void
    {
        // to implement
    }
}
