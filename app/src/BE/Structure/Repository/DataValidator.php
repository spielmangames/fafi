<?php

namespace FAFI\src\BE\Structure\Repository;

use FAFI\exception\EntityErr;
use FAFI\exception\FafiException;

class DataValidator
{
    /**
     * @param string $entityName
     * @param array $entityData
     * @param string[] $mandatory
     *
     * @return void
     * @throws FafiException
     */
    public function assertRequiredFieldsPresent(string $entityName, array $entityData, array $mandatory): void
    {
        $missed = [];
        foreach ($mandatory as $field) {
            if (!isset($entityData[$field])) {
                $missed[] = $field;
            }
        }

        if (!empty($missed)) {
            $missed = implode(FafiException::LIST_WRAPPED_SEPARATOR, $missed);
            throw new FafiException(sprintf(EntityErr::REQ_MISSED, $entityName, $missed));
        }
    }

    public function assertFieldOneOf($value, string $property, array $allowed): void
    {
        if (!in_array($value, $allowed)) {
            throw new FafiException(sprintf(EntityErr::E_VALUE_TYPE_INVALID_ENUM, $property));
        }
    }
}
