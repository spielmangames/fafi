<?php

namespace FAFI\db;

class QueryBuilder
{
    private string $query;


    public function add(string $add): string
    {
        return $this->query . ' ' . $add;
    }

    public function getQuery(): string
    {
        return $this->query;
    }
}
