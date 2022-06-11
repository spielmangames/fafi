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
    public function assertEntityMandatoryDataPresent(EntityInterface $entity, array $entityData, array $mandatory): void
    {
        $this->dataValidator->assertRequiredFieldsPresent($entity, $entityData, $mandatory);
    }

    public function assertEntityPropertyStr(string $entityName, array $entityData, string $property, ?int $lengthMin = null, ?int $lengthMax = null): void
    {
        $value = $entityData[$property];
        $length = mb_strlen($value);

        if (!is_int($length)) {
            throw new FafiException('ERRRORORRR!!!!');
        }

        if (!is_null($lengthMin) && $length < $lengthMin) {
            throw new FafiException('ERRRORORRR!!!!');
        }
        if (!is_null($lengthMax) && $length > $lengthMax) {
            throw new FafiException('ERRRORORRR!!!!');
        }
    }

    public function assertEntityPropertyInt(string $entityName, array $entityData, string $property, ?int $min = null, ?int $max = null): void
    {
        $value = $entityData[$property];

        if (!is_int($value)) {
            throw new FafiException('ERRRORORRR!!!!');
        }

        if (!is_null($min) && $value < $min) {
            throw new FafiException('ERRRORORRR!!!!');
        }
        if (!is_null($max) && $value > $max) {
            throw new FafiException('ERRRORORRR!!!!');
        }
    }

    public function assertEntityPropertyEnum(string $entityName, array $entityData, string $property, array $allowed): void
    {
        $value = $entityData[$property];

        if (!in_array($value, $allowed)) {
            throw new FafiException(sprintf(FafiException::E_VALUE_TYPE_INVALID_ENUM, $property));
        }
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
