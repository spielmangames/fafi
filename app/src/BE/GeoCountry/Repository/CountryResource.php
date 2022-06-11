<?php

namespace FAFI\src\BE\GeoCountry\Repository;

use FAFI\exception\FafiException;
use FAFI\src\BE\GeoCountry\Country;
use FAFI\src\BE\Structure\Repository\AbstractResource;

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


    private CountryHydrator $hydrator;

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
        if ($entity->getId()) {
            throw new FafiException(sprintf(FafiException::E_ID_PRESENT, Country::ENTITY));
        }

        $data = $this->hydrator->extract($entity);
        $this->entityValidator->assertEntityMandatoryDataPresent(Country::ENTITY, $data, self::REQUIRED_FIELDS);
        $id = $this->queryExecutor->createRecord(self::TABLE, $data);

        $criteria = new CountryCriteria([$id]);
        $result = $this->readFirst($criteria);
        if (!$result) {
            throw new FafiException(sprintf(FafiException::E_ENTITY_ABSENT, Country::ENTITY, $id));
        }

        return $result;
    }

    /**
     * @param CountryCriteria $criteria
     *
     * @return Country[]|null
     * @throws FafiException
     */
    public function read(CountryCriteria $criteria): ?array
    {
        $result = [];
        foreach ($this->queryExecutor->readRecords(self::TABLE, $criteria) as $record) {
            $result[] = $this->hydrator->hydrate($record);
        }

        return $result;
    }

    /**
     * @param CountryCriteria $criteria
     *
     * @return Country|null
     * @throws FafiException
     */
    public function readFirst(CountryCriteria $criteria): ?Country
    {
        $result = $this->queryExecutor->readRecords(self::TABLE, $criteria);
        return (!empty($result)) ? $this->hydrator->hydrate($result[0]) : null;
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
