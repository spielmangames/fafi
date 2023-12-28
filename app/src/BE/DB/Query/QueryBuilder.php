<?php

declare(strict_types=1);

namespace FAFI\src\BE\DB\Query;

use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;

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
        $values = $this->formData($data);
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

    private function formData(array $data): string
    {
        $converted = [];
        foreach ($data as $column => $value) {
            $converted[] = $column . QuerySyntax::OPERATOR_IS . $this->wrapValue($value);
        }

        return implode(QuerySyntax::SEPARATOR_LIST, $converted);
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
        return is_null($value)
            ? QuerySyntax::VALUE_ABSENT
            : QuerySyntax::WRAPPER_VALUE . $value . QuerySyntax::WRAPPER_VALUE;
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
            $operator = $condition->getOperator();
            $values = $this->formValues($condition->getValues());

            if ($operator === QuerySyntax::OPERATOR_IN) {
                $values = sprintf(QuerySyntax::STATEMENT_IN, $values);
            }

            $condition = [$condition->getFieldName(), $operator, $values];
            $converted[] = implode(' ', $condition);
        }

        return sprintf(QuerySyntax::STATEMENT_WHERE, implode(QuerySyntax::SEPARATOR_AND, $converted));
    }
}
