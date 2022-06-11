<?php

namespace FAFI\src\BE\Structure\Repository;

interface EntityCriteriaInterface
{
//    public const OPERATOR_ALL = '*';
//    public const OPERATOR_IN = 'in';
//    public const OPERATOR_IS = '=';


    public function getFieldName(): string;
    public function getOperator(): string;
    public function getValues(): array;

//    public function getCondition(): string;
}
