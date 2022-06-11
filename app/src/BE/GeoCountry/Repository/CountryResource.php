<?php

namespace FAFI\src\BE\GeoCountry\Repository;

use FAFI\db\QueryBuilder;
use FAFI\exception\FafiException;
use FAFI\src\BE\GeoCountry\Country;
use FAFI\src\BE\Player\Repository\Criteria;
use FAFI\src\BE\Structure\EntityInterface;
use FAFI\src\BE\Structure\Repository\AbstractResource;
use FAFI\src\BE\Structure\Repository\EntityCriteriaInterface;

class CountryResource extends AbstractResource
{
    public const TABLE = 'countries';
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


    /**
     * @param Country $entity
     *
     * @return Country
     * @throws FafiException
     */
    public function create(Country $entity): Country
    {
        $data = $this->hydrator->extract($entity);

        $this->verifyConstraintsOnCreate(self::TABLE, $entity, $data);
        $id = $this->queryExecutor->createRecord(self::TABLE, $data);

        $criteria = new Criteria(self::ID_FIELD, QueryBuilder::OPERATOR_IS, [$id]);
        $result = $this->readFirst([$criteria]);
        if (!$result) {
            throw new FafiException(sprintf(FafiException::E_ENTITY_ABSENT, $entity, $id));
        }

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
        $selection = $this->queryExecutor->readRecords(self::TABLE, $conditions);

        $result = [];
        foreach ($selection as $record) {
            $result[] = $this->hydrator->hydrate($record);
        }

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
        $selection = $this->read($conditions);
        return !empty($selection) ? array_shift($selection) : null;
    }

    /**
     * @param Country $entity
     *
     * @return Country
     * @throws FafiException
     */
    public function update(Country $entity): Country
    {
        if (!$entity->getId()) {
            throw new FafiException(FafiException::E_ID_ABSENT, Country::ENTITY);
        }
        $id = $entity->getId();

        $data = $this->hydrator->extract($entity);
        $this->queryExecutor->updateRecord(self::TABLE, $data, new CountryCriteria([$id]));

        $criteria = new CountryCriteria([$id]);
        $result = $this->readFirst($criteria);
        if (!$result) {
            throw new FafiException(sprintf(FafiException::E_ENTITY_ABSENT, Country::ENTITY, $id));
        }

        return $result;
    }
}
