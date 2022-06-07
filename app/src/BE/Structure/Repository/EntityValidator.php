<?php

namespace FAFI\src\BE\Structure\Repository;

use FAFI\exception\FafiException;
use FAFI\src\BE\Structure\EntityInterface;

class EntityValidator
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
            $e = sprintf(FafiException::E_REQ_MISSED, $entityName, implode('", "', $missed));
            throw new FafiException($e);
        }
    }

    /**
     * @param EntityInterface $entity
     * @param string $entityName
     *
     * @return void
     * @throws FafiException
     */
    public function assertEntityHasId(EntityInterface $entity, string $entityName): void
    {
        if (!$entity->getId()) {
            throw new FafiException(sprintf(FafiException::E_ID_ABSENT, $entityName));
        }
    }

    /**
     * @param EntityInterface $entity
     * @param string $entityName
     *
     * @return void
     * @throws FafiException
     */
    public function assertEntityHasNoId(EntityInterface $entity, string $entityName): void
    {
        if ($entity->getId()) {
            throw new FafiException(sprintf(FafiException::E_ID_PRESENT, $entityName));
        }
    }
}
