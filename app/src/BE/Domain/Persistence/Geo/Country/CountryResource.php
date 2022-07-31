<?php

namespace FAFI\src\BE\Domain\Persistence\Geo\Country;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\Geo\Country\Country;
use FAFI\src\BE\Domain\Persistence\AbstractResource;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;

class CountryResource extends AbstractResource
{
    private const TABLE = 'countries';
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

    protected function getRequiredFields(): array
    {
        return self::REQUIRED_FIELDS;
    }

    protected function getUniqueFields(): array
    {
        return self::UNIQUE_FIELDS;
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


    protected function verifyModelPropertiesConstraints(array $data): void
    {
        // to implement
    }
}
