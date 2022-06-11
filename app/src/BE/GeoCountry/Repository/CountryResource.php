<?php

namespace FAFI\src\BE\GeoCountry\Repository;

use FAFI\exception\FafiException;
use FAFI\src\BE\GeoCountry\Country;
use FAFI\src\BE\Structure\EntityInterface;
use FAFI\src\BE\Structure\Repository\AbstractResource;
use FAFI\src\BE\Structure\Repository\EntityCriteriaInterface;

class CountryResource extends AbstractResource
{
    private const TABLE = 'countries';
    public const COLUMNS = [
        self::ID_FIELD,

        self::NAME_FIELD,
    ];
    public const REQUIRED_FIELDS = [
        self::NAME_FIELD,
    ];


    public const NAME_FIELD = 'name';


    protected CountryHydrator $hydrator;

    public function __construct()
    {
        parent::__construct();
        $this->hydrator = new CountryHydrator();
    }

    protected function getTable(): string
    {
        return self::TABLE;
    }


    /**
     * @param Country $entity
     *
     * @return Country
     * @throws FafiException
     */
    public function create($entity): Country
    {
        /** @var Country $result */
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
     * @return Country[]|null
     * @throws FafiException
     */
    public function read(array $conditions = []): ?array
    {
        /** @var Country[]|null $result */
        $result = parent::read($conditions);

        return $result;
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return Country|null
     * @throws FafiException
     */
    public function readFirst(array $conditions): ?Country
    {
        /** @var Country|null $result */
        $result = parent::readFirst($conditions);

        return $result;
    }

    /**
     * @param Country $entity
     *
     * @return Country
     * @throws FafiException
     */
    public function update($entity): Country
    {
        /** @var Country $result */
        $result = parent::update($entity);

        return $result;
    }

    protected function verifyConstraintsOnUpdate(string $table, EntityInterface $entity, array $data): void
    {
        // to implement
    }
}
