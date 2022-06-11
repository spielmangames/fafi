<?php

namespace FAFI\src\BE\Player\Repository;

use FAFI\src\BE\Structure\Repository\EntityCriteriaInterface;

class Criteria implements EntityCriteriaInterface
{
    private string $fieldName;
    private string $operator;
    private array $values;

//    private string $condition;


    public function __construct(string $fieldName, string $operator, array $values)
    {
        $this->fieldName = $fieldName;
        $this->operator = $operator;
        $this->values = $values;
    }

    public function getFieldName(): string
    {
        return $this->fieldName;
    }

    public function getOperator(): string
    {
        return $this->operator;
    }

    public function getValues(): array
    {
        return $this->values;
    }


//    public function setCondition(): void
//    {
//        $condition = '';
//
//        $this->condition = $condition;
//    }
//
//    public function getCondition(): string
//    {
//        if (!isset($this->condition)) {
//            $this->setCondition();
//        }
//
//        return $this->condition;
//    }
}
