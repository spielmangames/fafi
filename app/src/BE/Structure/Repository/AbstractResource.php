<?php

namespace FAFI\src\BE\Structure\Repository;

use FAFI\db\QueryBuilder;
use FAFI\db\QueryRunner;
use FAFI\exception\FafiException;
use FAFI\src\BE\Player\Repository\Criteria;

class AbstractResource
{
    public const ID_FIELD = 'id';


    protected EntityValidator $entityValidator;
    protected QueryRunner $queryRunner;

    public function __construct()
    {
        $this->entityValidator = new EntityValidator();
        $this->queryRunner = new QueryRunner();
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
        $result = $this->queryRunner->readRecords($table, [$condition]);

        if ($result) {
            throw new FafiException(sprintf(FafiException::E_ENTITY_NOT_UNIQUE, $entityName, $property));
        }
    }
}
