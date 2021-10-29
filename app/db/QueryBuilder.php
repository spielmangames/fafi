<?php

namespace FAFI\db;

use FAFI\entity\AbstractResource;
use FAFI\entity\EntityCriteriaInterface;

class QueryBuilder
{
    // sql
    private const INSERT = 'INSERT INTO %s (%s) VALUES (%s);';
    private const SELECT = 'SELECT %s FROM %s %s;';
    private const WHERE = 'WHERE ';


    private string $query;


    public function add(string $add): string
    {
        return $this->query . ' ' . $add;
    }

    public function filterOutEmpty(array $data): array
    {
        return array_filter($data);
    }

    public function formColumns(array $data): string
    {
        return implode(', ', array_keys($data));
    }

    public function formValues(array $data): string
    {
        return '"' . implode('", "', $data) . '"';
    }

    public function getQuery(): string
    {
        return $this->query;
    }

    private function close(): string
    {
        $query = $this->query;
        $end = substr($query, -1);
        if ($end !== ';') {
            $query .= ';';
        }

        return $query;
    }

    public function formInsert(string $table, array $playerData): string
    {
        return sprintf(self::INSERT, $table, $this->formColumns($playerData), $this->formValues($playerData));
    }

    public function formSelect(string $table, EntityCriteriaInterface $criteria): string
    {
        return sprintf(
            self::SELECT,
            '*',
            $table,
            $criteria->isEmpty() ? '' : $this->formWhere($criteria)
        );
    }

    private function formWhere(EntityCriteriaInterface $criteria): string
    {
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
}
