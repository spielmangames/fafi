<?php

namespace FAFI\src\BE\Structure\Repository;

use FAFI\exception\FafiException;

class EntityValidator
{
    /**
     * @param string $entityName
     * @param array $entityData
     * @param array $mandatory
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
            $e = sprintf(FafiException::E_REQ_MISSED, $entityName, implode('", "', $missed));
            throw new FafiException($e);
        }
    }
}
