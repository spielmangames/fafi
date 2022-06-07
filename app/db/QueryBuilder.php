<?php

namespace FAFI\db;

class QueryBuilder
{
    public const STATEMENT_SELECT = 'SELECT %s FROM %s%s';
    public const STATEMENT_WHERE = ' WHERE %s';
    public const STATEMENT_INSERT = 'INSERT INTO %s (%s) VALUES (%s)';

    public const OPERATOR_ALL = '*';
    public const OPERATOR_IN = 'in';
    public const OPERATOR_IS = '=';
    public const OPERATOR_CLOSE = ';';

    public const WRAPPER_VALUE = "'";
    public const SEPARATOR_LIST = ', ';
    public const SEPARATOR_AND = ' AND ';


    public function select(string $destination, array $conditions = [], array $fields = []): string
    {
        $what = $this->formWhat($fields);
        $where = $this->formWhere($conditions);

        return sprintf(self::STATEMENT_SELECT, $what, $destination, $where);
    }

    public function insert(string $destination, array $data): string
    {
        $columns = $this->formWhat(array_keys($data));
        $values = $this->formValues($data);

        return sprintf(self::STATEMENT_INSERT, $destination, $columns, $values);
    }

    public function close(string $query): string
    {
        return $query . self::OPERATOR_CLOSE;
    }


    private function formWhat(array $fields): string
    {
        if (empty($fields)) {
            return self::OPERATOR_ALL;
        }

        return implode(self::SEPARATOR_LIST, $fields);
    }

    private function formWhere(array $conditions): string
    {
        if (empty($conditions)) {
            return '';
        }

        $converted = [];
        foreach ($conditions as $condition) {
            $condition[2] = $this->wrapValue($condition[2]);
            $converted[] = implode(' ', $condition);
        }

        return sprintf(self::STATEMENT_WHERE, implode(self::SEPARATOR_AND, $converted));
    }

    private function formValues(array $data): string
    {
        $values = [];
        foreach ($data as $value) {
            $values[] = $this->wrapValue($value);
        }

        return implode(self::SEPARATOR_LIST, $values);
    }

    private function wrapValue($value): string
    {
        return self::WRAPPER_VALUE . $value . self::WRAPPER_VALUE;
    }
}
