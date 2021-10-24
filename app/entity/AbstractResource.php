<?php

namespace FAFI\entity;

use FAFI\db\DatabaseConnection;
use FAFI\db\QueryBuilder;

class AbstractResource
{
    protected DatabaseConnection $dbConnection;
    protected QueryBuilder $queryBuilder;

    public function __construct()
    {
        $this->dbConnection = new DatabaseConnection();
        $this->queryBuilder = new QueryBuilder();
    }
}
