<?php

namespace FAFI\src\BE\Domain\Persistence;

use FAFI\exception\EntityErr;
use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\EntityInterface;

class EntityValidator
{
    private DataValidator $dataValidator;

    public function __construct()
    {
        $this->dataValidator = new DataValidator();
    }


    /**
     * @param \FAFI\src\BE\Domain\Dto\EntityInterface $entity
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

    public function assertEntityPropertyStr($value, string $property, ?int $lengthMin = null, ?int $lengthMax = null): void
    {
        $this->dataValidator->assertFieldStr($value, $property, $lengthMin, $lengthMax);
    }

    public function assertEntityPropertyInt($value, string $property, ?int $min = null, ?int $max = null): void
    {
        $this->dataValidator->assertFieldInt($value, $property, $min, $max);
    }

    public function assertEntityPropertyEnum($value, string $property, array $allowed): void
    {
        $this->dataValidator->assertFieldOneOf($value, $property, $allowed);
    }


    /**
     * @param \FAFI\src\BE\Domain\Dto\EntityInterface $entity
     *
     * @return void
     * @throws FafiException
     */
    public function assertEntityIdPresent(EntityInterface $entity): void
    {
        if (!$entity->getId()) {
            throw new FafiException(sprintf(EntityErr::ID_ABSENT, $entity));
        }
    }

    /**
     * @param \FAFI\src\BE\Domain\Dto\EntityInterface $entity
     *
     * @return void
     * @throws FafiException
     */
    public function assertEntityIdAbsent(EntityInterface $entity): void
    {
        if ($entity->getId()) {
            throw new FafiException(sprintf(EntityErr::ID_PRESENT, $entity));
        }
    }
}
