<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence;

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
    public static function assertRequiredFieldsPresent(string $entityName, array $entityData, array $mandatory): void
    {
        $missed = [];
        foreach ($mandatory as $field) {
            if (!isset($entityData[$field])) {
                $missed[] = $field;
            }
        }

        if (!empty($missed)) {
            $missed = implode(FafiException::LIST_WRAPPED_SEPARATOR, $missed);
            throw new FafiException(sprintf(EntityErr::REQ_ABSENT, $entityName, $missed));
        }
    }


    public static function assertFieldArr(mixed $value, string $property): void
    {
        if (!is_array($value)) {
            throw new FafiException(sprintf(EntityErr::VALUE_TYPE_INVALID_ARR, $property));
        }
    }

    public static function assertFieldBool(mixed $value, string $property): void
    {
        if (!is_bool($value)) {
            throw new FafiException(sprintf(EntityErr::VALUE_TYPE_INVALID_BOOL, $property));
        }
    }

    public static function assertFieldOneOf(mixed $value, string $property, array $allowed): void
    {
        if (!in_array($value, $allowed)) {
            throw new FafiException(sprintf(EntityErr::VALUE_TYPE_INVALID_ENUM, $property, $value));
        }
    }

    public static function assertFieldInt(mixed $value, string $property, ?int $min = null, ?int $max = null): void
    {
        if (!is_int($value)) {
            throw new FafiException(sprintf(EntityErr::VALUE_TYPE_INVALID_INT, $property));
        }

        if (!is_null($min) && $value < $min) {
            throw new FafiException(sprintf(EntityErr::VALUE_DIGIT_MIN_RANGE_CROSSED, $property, $min));
        }
        if (!is_null($max) && $value > $max) {
            throw new FafiException(sprintf(EntityErr::VALUE_DIGIT_MAX_RANGE_CROSSED, $property, $max));
        }
    }

    public static function assertFieldStr(mixed $value, string $property, ?int $lengthMin = null, ?int $lengthMax = null): void
    {
        if (!is_string($value)) {
            throw new FafiException(sprintf(EntityErr::VALUE_TYPE_INVALID_STR, $property));
        }

        $length = mb_strlen($value);
        if (!is_null($lengthMin) && $length < $lengthMin) {
            throw new FafiException(sprintf(EntityErr::VALUE_STR_MIN_LENGTH_CROSSED, $property, $lengthMin));
        }
        if (!is_null($lengthMax) && $length > $lengthMax) {
            throw new FafiException(sprintf(EntityErr::VALUE_STR_MAX_LENGTH_CROSSED, $property, $lengthMax));
        }
    }
}
