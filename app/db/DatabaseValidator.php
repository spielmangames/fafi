<?php

namespace FAFI\db;

use FAFI\exception\FafiException;
use FAFI\src\BE\Player\Repository\Criteria;

class DatabaseValidator
{
    protected QueryExecutor $queryExecutor;

    public function __construct()
    {
        $this->queryExecutor = new QueryExecutor();
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
    public function assertResourcePropertyUnique(string $table, string $entityName, array $entityData, string $property): void
    {
        $condition = new Criteria($property, QueryBuilder::OPERATOR_IS, [$entityData[$property]]);
        $result = $this->queryExecutor->readRecords($table, [$condition]);

        if ($result) {
            throw new FafiException(sprintf(FafiException::E_ENTITY_NOT_UNIQUE, $entityName, $property));
        }
    }
}
