<?php

namespace FAFI\db;

use FAFI\src\BE\Structure\Repository\AbstractResource;
use FAFI\src\BE\Structure\Repository\EntityCriteriaInterface;

class QueryBuilder
{
    private const INSERT = 'INSERT INTO %s (%s) VALUES (%s);';
    private const UPDATE = 'UPDATE %s SET %s %s;';
    private const SELECT = 'SELECT %s FROM %s %s;';
    private const WHERE = 'WHERE ';
    private const ALL = '*';


    private string $query;


    public function formInsert(string $table, array $data): string
    {
        return sprintf(self::INSERT, $table, $this->formInsertColumns($data), $this->formInsertValues($data));
    }

    private function formInsertColumns(array $data): string
    {
        return implode(', ', array_keys($data));
    }

    private function formInsertValues(array $data): string
    {
        return '"' . implode('", "', $data) . '"';
    }


    public function formUpdate(string $table, array $data, EntityCriteriaInterface $criteria): string
    {
        return sprintf(self::UPDATE, $table, $this->formUpdateData($data), $this->formWhere($criteria));
    }

    private function formUpdateData(array $data): string
    {
        $set = [];
        foreach  ($data as $column => $value) {
            $set[] = sprintf('%s = "%s"', $column, $value);
        }

        return implode(', ', $set);
    }


    public function formSelect(string $table, EntityCriteriaInterface $criteria): string
    {
        return sprintf(self::SELECT, self::ALL, $table, $this->formWhere($criteria));
    }


    private function formWhere(EntityCriteriaInterface $criteria): string
    {
        if ($criteria->isEmpty()) {
            return '';
        }

        // SELECT * FROM players WHERE id IN (17,18,19,22) AND surname = 'Serginho';

        $conditions = [];

        if ($criteria->getIds()) {
            $ids = $criteria->getIds();
            $ids = implode(', ', $ids);
            $conditions[] = sprintf(' %s IN (%s)', AbstractResource::ID_FIELD, $ids);
        }

        $query = implode(' AND ', $conditions);

        return self::WHERE . $query;
    }


//    public function add(string $add): string
//    {
//        return $this->query . ' ' . $add;
//    }

//    private function close(): string
//    {
//        $query = $this->query;
//        $end = substr($query, -1);
//        if ($end !== ';') {
//            $query .= ';';
//        }
//
//        return $query;
//    }

//    public function getQuery(): string
//    {
//        return $this->query;
//    }
}
