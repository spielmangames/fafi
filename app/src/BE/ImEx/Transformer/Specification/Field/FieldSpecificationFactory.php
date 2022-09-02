<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Field;

use FAFI\exception\FafiException;
use FAFI\exception\ImExErr;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Player\PlayerAttributesSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\BooleanSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\EnumSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IdSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IntegerSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\StringSpecification;

class FieldSpecificationFactory
{
    /**
     * @param string $class
     * @param array|null $params
     *
     * @return FieldSpecification
     * @throws FafiException
     */
    public function create(string $class, ?array $params = null): FieldSpecification
    {
        switch ($class) {
            // typical
            case BooleanSpecification::class:
                return $this->createBoolSpecification();
            case EnumSpecification::class:
                return $this->createEnumSpecification($params);
            case IdSpecification::class:
                return $this->createIdSpecification();
            case IntegerSpecification::class:
                return $this->createIntSpecification($params);
            case StringSpecification::class:
                return $this->createStrSpecification($params);

            // Player
            case PlayerAttributesSpecification::class:
                return new PlayerAttributesSpecification();
        }

        throw new FafiException(sprintf(FafiException::E_CLASS_ABSENT, $class));
    }


    private function createBoolSpecification(): BooleanSpecification
    {
        return new BooleanSpecification();
    }

    /**
     * @param array $params
     *
     * @return EnumSpecification
     * @throws FafiException
     */
    private function createEnumSpecification(array $params): EnumSpecification
    {
        if (!isset($params[EnumSpecification::PARAM_SUPPORTED])) {
            $e = sprintf(ImExErr::IMPORT_ENTITY_FIELD_SPECIFICATION_PARAM_INVALID, EnumSpecification::PARAM_SUPPORTED);
            throw new FafiException($e);
        }
        $supported = $params[EnumSpecification::PARAM_SUPPORTED];
        if (!is_array($supported) || empty($supported)) {
            $e = sprintf(ImExErr::IMPORT_ENTITY_FIELD_SPECIFICATION_PARAM_INVALID, EnumSpecification::PARAM_SUPPORTED);
            throw new FafiException($e);
        }

        return new EnumSpecification($supported);
    }

    private function createIdSpecification(): IdSpecification
    {
        return new IdSpecification();
    }

    /**
     * @param array $params
     *
     * @return IntegerSpecification
     * @throws FafiException
     */
    private function createIntSpecification(array $params): IntegerSpecification
    {
        list($min, $max) = null;

        if (isset($params[IntegerSpecification::PARAM_MIN])) {
            $min = $params[IntegerSpecification::PARAM_MIN];
            if (!is_int($min)) {
                $e = sprintf(ImExErr::IMPORT_ENTITY_FIELD_SPECIFICATION_PARAM_INVALID, IntegerSpecification::PARAM_MIN);
                throw new FafiException($e);
            }
        }

        if (isset($params[IntegerSpecification::PARAM_MAX])) {
            $max = $params[IntegerSpecification::PARAM_MAX];
            if (!is_int($max)) {
                $e = sprintf(ImExErr::IMPORT_ENTITY_FIELD_SPECIFICATION_PARAM_INVALID, IntegerSpecification::PARAM_MAX);
                throw new FafiException($e);
            }
        }

        return new IntegerSpecification($min, $max);
    }

    /**
     * @param array $params
     *
     * @return StringSpecification
     * @throws FafiException
     */
    private function createStrSpecification(array $params): StringSpecification
    {
        list($min, $max) = null;

        if (isset($params[StringSpecification::PARAM_MIN])) {
            $min = $params[StringSpecification::PARAM_MIN];
            if (!is_int($min)) {
                $e = sprintf(ImExErr::IMPORT_ENTITY_FIELD_SPECIFICATION_PARAM_INVALID, StringSpecification::PARAM_MIN);
                throw new FafiException($e);
            }
        }

        if (isset($params[StringSpecification::PARAM_MAX])) {
            $max = $params[StringSpecification::PARAM_MAX];
            if (!is_int($max)) {
                $e = sprintf(ImExErr::IMPORT_ENTITY_FIELD_SPECIFICATION_PARAM_INVALID, StringSpecification::PARAM_MAX);
                throw new FafiException($e);
            }
        }

        return new StringSpecification($min, $max);
    }
}