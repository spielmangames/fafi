<?php

namespace FAFI\src\BE\Structure\Repository;

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
            throw new FafiException(sprintf(FafiException::E_REQ_MISSED, $entityName, $missed));
        }
    }
}