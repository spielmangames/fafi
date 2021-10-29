<?php

namespace FAFI\entity;

use FAFI\db\DatabaseConnection;
use FAFI\db\QueryBuilder;

class AbstractResource
{
    // profile basic
    public const ID_FIELD = 'id';


    protected DatabaseConnection $dbConnection;
    protected QueryBuilder $queryBuilder;

    public function __construct()
    {
        $this->dbConnection = new DatabaseConnection();
        $this->queryBuilder = new QueryBuilder();
    }
}
