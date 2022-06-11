<?php

namespace FAFI\src\BE\Structure\Repository;

use FAFI\db\DatabaseConnector;
use FAFI\db\DatabaseDispatcher;
use FAFI\db\QueryBuilder;
use FAFI\exception\FafiException;
use FAFI\src\BE\Player\Repository\Criteria;

class AbstractResource
{
    public const ID_FIELD = 'id';


    protected DatabaseConnector $dbConnector;
    protected DatabaseDispatcher $dbDispatcher;
    protected QueryBuilder $queryBuilder;

    protected EntityValidator $entityValidator;

    public function __construct()
    {
        $this->dbConnector = new DatabaseConnector();
        $this->dbDispatcher = new DatabaseDispatcher();
        $this->queryBuilder = new QueryBuilder();

        $this->entityValidator = new EntityValidator();
    }


    /**
     * @param string $table
     * @param array $data
     *
     * @return int
     * @throws FafiException
     */
    protected function createRecord(string $table, array $data): int
    {
        $query = $this->queryBuilder->insert($table, $data);
        $query = $this->queryBuilder->close($query);

        return $this->dbDispatcher->writeRead($query);
    }

    /**
     * @param string $table
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return array
     * @throws FafiException
     */
    protected function readRecords(string $table, array $conditions): array
    {
        $query = $this->queryBuilder->select($table, $conditions);
        $query = $this->queryBuilder->close($query);

        return $this->dbDispatcher->read($query);
    }

    /**
     * @param string $table
     * @param array $data
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return void
     * @throws FafiException
     */
    protected function updateRecord(string $table, array $data, array $conditions): void
    {
        $query = $this->queryBuilder->update($table, $data, $conditions);
        $query = $this->queryBuilder->close($query);

        $this->dbDispatcher->write($query);
    }

    /**
     * @param string $table
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return void
     * @throws FafiException
     */
    protected function deleteRecords(string $table, array $conditions): void
    {
        $query = $this->queryBuilder->delete($table, $conditions);
        $query = $this->queryBuilder->close($query);

        $this->dbDispatcher->write($query);
    }


    /**
     * @param string $table
     * @param string $entityName
     * @param array $entityData
     * @param string $property
     *
     * @return void
     * @throws FafiException
     */
    protected function assertResourcePropertyUnique(string $table, string $entityName, array $entityData, string $property): void
    {
        $condition = new Criteria($property, QueryBuilder::OPERATOR_IS, [$entityData[$property]]);
        $result = $this->readRecords($table, [$condition]);

        if ($result) {
            throw new FafiException(sprintf(FafiException::E_ENTITY_NOT_UNIQUE, $entityName, $property));
        }
    }
}
