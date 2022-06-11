<?php

namespace FAFI\src\BE\Structure\Repository;

use FAFI\exception\FafiException;
use FAFI\src\BE\Structure\EntityInterface;

class EntityValidator
{
    private DataValidator $dataValidator;

    public function __construct()
    {
        $this->dataValidator = new DataValidator();
    }


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
        $this->dataValidator->assertRequiredFieldsPresent($entityName, $entityData, $mandatory);
    }


    /**
     * @param EntityInterface $entity
     *
     * @return void
     * @throws FafiException
     */
    public function assertEntityIdPresent(EntityInterface $entity): void
    {
        if (!$entity->getId()) {
            throw new FafiException(sprintf(FafiException::E_ID_ABSENT, $entity));
        }
    }

    /**
     * @param EntityInterface $entity
     *
     * @return void
     * @throws FafiException
     */
    public function assertEntityIdAbsent(EntityInterface $entity): void
    {
        if ($entity->getId()) {
            throw new FafiException(sprintf(FafiException::E_ID_PRESENT, $entity));
        }
    }
}
