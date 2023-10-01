<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence;

use FAFI\exception\EntityErr;
use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\EntityInterface;

class EntityValidator
{
    private const E_CLASS_UNEXPECTED = 'Provided class "%s" is not expected "%s".';

    /**
     * @param string $expected
     * @param EntityDataInterface $actual
     *
     * @return void
     * @throws FafiException
     */
    public static function verifyInterface(string $expected, EntityDataInterface $actual): void
    {
        if ($actual instanceof $expected) {
            return;
        }

        throw new FafiException(sprintf(self::E_CLASS_UNEXPECTED, $actual::class, $expected));
    }


    /**
     * @param EntityInterface $entity
     * @param array $entityData
     * @param string[] $mandatory
     *
     * @return void
     * @throws FafiException
     */
    public static function assertEntityMandatoryDataPresent(EntityInterface $entity, array $entityData, array $mandatory): void
    {
        DataValidator::assertRequiredFieldsPresent($entity, $entityData, $mandatory);
    }

    public static function assertEntityPropertyStr($value, string $property, ?int $lengthMin = null, ?int $lengthMax = null): void
    {
        DataValidator::assertFieldStr($value, $property, $lengthMin, $lengthMax);
    }

    public static function assertEntityPropertyInt($value, string $property, ?int $min = null, ?int $max = null): void
    {
        DataValidator::assertFieldInt($value, $property, $min, $max);
    }

    public static function assertEntityPropertyEnum($value, string $property, array $allowed): void
    {
        DataValidator::assertFieldOneOf($value, $property, $allowed);
    }


    /**
     * @param EntityInterface $entity
     *
     * @return void
     * @throws FafiException
     */
    public static function assertEntityIdPresent(EntityInterface $entity): void
    {
        if (!$entity->getId()) {
            throw new FafiException(sprintf(EntityErr::ID_ABSENT, $entity));
        }
    }

    /**
     * @param EntityInterface $entity
     *
     * @return void
     * @throws FafiException
     */
    public static function assertEntityIdAbsent(EntityInterface $entity): void
    {
        if ($entity->getId()) {
            throw new FafiException(sprintf(EntityErr::ID_PRESENT, $entity));
        }
    }
}
