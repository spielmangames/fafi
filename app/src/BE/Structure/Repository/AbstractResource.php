<?php

namespace FAFI\src\BE\Structure\Repository;

use FAFI\db\DatabaseValidator;
use FAFI\db\QueryExecutor;
use FAFI\src\BE\Structure\EntityInterface;

abstract class AbstractResource
{
    public const ID_FIELD = 'id';


    protected EntityValidator $entityValidator;
    protected DatabaseValidator $dbValidator;

    protected QueryExecutor $queryExecutor;

    public function __construct()
    {
        $this->entityValidator = new EntityValidator();
        $this->dbValidator = new DatabaseValidator();

        $this->queryExecutor = new QueryExecutor();
    }


    abstract protected function verifyConstraintsOnCreate(string $table, EntityInterface $entity, array $data): void;
}
