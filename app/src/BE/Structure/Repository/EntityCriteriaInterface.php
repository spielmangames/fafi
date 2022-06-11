<?php

namespace FAFI\src\BE\Structure\Repository;

interface EntityCriteriaInterface
{
    public function getFieldName(): string;
    public function getOperator(): string;
    public function getValues(): array;

//    public function getCondition(): string;
}
