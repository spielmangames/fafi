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
}
