<?php

namespace FAFI\db;

use FAFI\entity\AbstractResource;
use FAFI\entity\EntityCriteriaInterface;

class QueryBuilder
{
    private const INSERT = 'INSERT INTO %s (%s) VALUES (%s);';
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
