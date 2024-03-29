<?php

declare(strict_types=1);

namespace FAFI\src\BE\DB;

use FAFI\exception\EntityErr;
use FAFI\exception\FafiException;
use FAFI\src\BE\DB\Query\QueryExecutor;
use FAFI\src\BE\DB\Query\QuerySyntax;
use FAFI\src\BE\Domain\Criteria;
use FAFI\src\BE\Domain\Persistence\AbstractResource;

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
    public function assertPropertyUnique(string $table, string $entityName, array $entityData, string $property): void
    {
        $condition = new Criteria($property, QuerySyntax::OPERATOR_IS, [$entityData[$property]]);
        $result = $this->queryExecutor->readRecords($table, [$condition]);

        if ($result && !$this->isSameRecord($result, $entityData)) {
            throw new FafiException(sprintf(EntityErr::ENTITY_NOT_UNIQUE, $entityName, $property));
        }
    }

    private function isSameRecord(array $result, array $entityData): bool
    {
        $id = AbstractResource::ID_FIELD;
        return count($result) === 1 && $entityData[$id] === (int)array_shift($result)[$id];
    }
}
