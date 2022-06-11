<?php

namespace FAFI\db;

use FAFI\src\BE\Structure\Repository\EntityCriteriaInterface;

class QueryBuilder
{
    public function insert(string $destination, array $data): string
    {
        $columns = $this->formWhat(array_keys($data));
        $values = $this->formValues($data);

        return sprintf(QuerySyntax::STATEMENT_INSERT, $destination, $columns, $values);
    }

    public function select(string $destination, array $conditions = [], array $fields = []): string
    {
        $what = $this->formWhat($fields);
        $where = $this->formWhere($conditions);

        return sprintf(QuerySyntax::STATEMENT_SELECT, $what, $destination, $where);
    }

    public function update(string $destination, array $data, array $conditions = []): string
    {
        $values = $this->formValues($data);
        $where = $this->formWhere($conditions);

        return sprintf(QuerySyntax::STATEMENT_UPDATE, $destination, $values, $where);
    }

    public function delete(string $destination, array $conditions = []): string
    {
        $where = $this->formWhere($conditions);

        return sprintf(QuerySyntax::STATEMENT_DELETE, $destination, $where);
    }

    public function close(string $query): string
    {
        return $query . QuerySyntax::WRAPPER_CLOSE;
    }


    private function formWhat(array $fields): string
    {
        if (empty($fields)) {
            return QuerySyntax::OPERATOR_ALL;
        }

        return implode(QuerySyntax::SEPARATOR_LIST, $fields);
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return string
     */
    private function formWhere(array $conditions): string
    {
        if (empty($conditions)) {
            return '';
        }

        $converted = [];
        foreach ($conditions as $condition) {
            $condition = [
                $condition->getFieldName(),
                $condition->getOperator(),
                $this->formValues($condition->getValues()),
            ];

            $converted[] = implode(' ', $condition);
        }

        return sprintf(QuerySyntax::STATEMENT_WHERE, implode(QuerySyntax::SEPARATOR_AND, $converted));
    }

    private function formValues(array $data): string
    {
        $values = [];
        foreach ($data as $value) {
            $values[] = $this->wrapValue($value);
        }

        return implode(QuerySyntax::SEPARATOR_LIST, $values);
    }

    private function wrapValue($value): string
    {
        return QuerySyntax::WRAPPER_VALUE . $value . QuerySyntax::WRAPPER_VALUE;
    }
}
