<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Field;

use FAFI\exception\FafiException;
use FAFI\exception\ImExErr;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Player\PlayerAttributesSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\BooleanSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IntegerSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\OneOfSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\StringSpecification;

class ImExFieldSpecificationFactory
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
                return new BooleanSpecification();
            case IntegerSpecification::class:
                return new IntegerSpecification();
            case OneOfSpecification::class:
                return new OneOfSpecification();
            case StringSpecification::class:
                return $this->createStringSpecification($params);

            // Player
            case PlayerAttributesSpecification::class:
                return new PlayerAttributesSpecification();
        }

        throw new FafiException(sprintf(FafiException::E_CLASS_ABSENT, $class));
    }


    /**
     * @param array $params
     *
     * @return StringSpecification
     * @throws FafiException
     */
    private function createStringSpecification(array $params): StringSpecification
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
