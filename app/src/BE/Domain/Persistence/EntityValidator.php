<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence;

use FAFI\exception\EntityErr;
use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;

class EntityValidator
{
    /**
     * @param string $expectedType
     * @param EntityDataInterface $entity
     *
     * @return void
     * @throws FafiException
     */
    public static function assertEntityType(string $expectedType, EntityDataInterface $entity): void
    {
        if ($entity instanceof $expectedType) {
            return;
        }

        throw new FafiException(sprintf(EntityErr::ENTITY_UNEXPECTED, $entity::class, $expectedType));
    }


    /**
     * @param EntityDataInterface $entity
     * @param array $entityData
     * @param string[] $mandatory
     *
     * @return void
     * @throws FafiException
     */
    public static function assertEntityMandatoryDataPresent(EntityDataInterface $entity, array $entityData, array $mandatory): void
    {
        DataValidator::assertRequiredFieldsPresent($entity::class, $entityData, $mandatory);
    }

    public static function assertEntityPropertyStr(mixed $value, string $property, ?int $lengthMin = null, ?int $lengthMax = null): void
    {
        DataValidator::assertFieldStr($value, $property, $lengthMin, $lengthMax);
    }

    public static function assertEntityPropertyInt(mixed $value, string $property, ?int $min = null, ?int $max = null): void
    {
        DataValidator::assertFieldInt($value, $property, $min, $max);
    }

    public static function assertEntityPropertyEnum(mixed $value, string $property, array $allowed): void
    {
        DataValidator::assertFieldOneOf($value, $property, $allowed);
    }


    /**
     * @param EntityDataInterface $entity
     *
     * @return void
     * @throws FafiException
     */
    public static function assertEntityIdPresent(EntityDataInterface $entity): void
    {
        if (!$entity->getId()) {
            throw new FafiException(sprintf(EntityErr::ID_ABSENT, $entity::class));
        }
    }

    /**
     * @param EntityDataInterface $entity
     *
     * @return void
     * @throws FafiException
     */
    public static function assertEntityIdAbsent(EntityDataInterface $entity): void
    {
        if ($entity->getId()) {
            throw new FafiException(sprintf(EntityErr::ID_PRESENT, $entity::class));
        }
    }
}
