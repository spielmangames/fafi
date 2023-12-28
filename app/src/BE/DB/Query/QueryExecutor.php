<?php

declare(strict_types=1);

namespace FAFI\src\BE\DB\Query;

use FAFI\exception\FafiException;
use FAFI\src\BE\DB\DatabaseDispatcher;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;

class QueryExecutor
{
    protected QueryBuilder $queryBuilder;
    protected DatabaseDispatcher $dbDispatcher;

    public function __construct()
    {
        $this->queryBuilder = new QueryBuilder();
        $this->dbDispatcher = new DatabaseDispatcher();
    }


    /**
     * @param string $table
     * @param array $data
     *
     * @return int
     * @throws FafiException
     */
    public function createRecord(string $table, array $data): int
    {
        $query = $this->queryBuilder->insert($table, $data);
        $query = $this->queryBuilder->close($query);

        return $this->dbDispatcher->write($query);
    }

    /**
     * @param string $table
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return array
     * @throws FafiException
     */
    public function readRecords(string $table, array $conditions): array
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
    public function updateRecord(string $table, array $data, array $conditions): void
    {
        $query = $this->queryBuilder->update($table, $data, $conditions);
        $query = $this->queryBuilder->close($query);

        $this->dbDispatcher->rewrite($query);
    }

    /**
     * @param string $table
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return void
     * @throws FafiException
     */
    public function deleteRecords(string $table, array $conditions): void
    {
        $query = $this->queryBuilder->delete($table, $conditions);
        $query = $this->queryBuilder->close($query);

        $this->dbDispatcher->rewrite($query);
    }
}
