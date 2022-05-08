<?php

declare(strict_types=1);

namespace FAFI\entity\ImEx\Transformer\Specification\Field\Typical;

use FAFI\exception\FafiException;

class IntegerSpecification implements ImExFieldSpecification
{
    private const E_VALUE_TYPE_INVALID = 'Property %s must be integer.';


    public function validate(): bool
    {
        return false;
    }

    /**
     * @param string $property
     * @param $value
     *
     * @return void
     * @throws FafiException
     */
    private function assertInt(string $property, $value): void
    {
        if (!is_int($value)) {
            throw new FafiException(sprintf(self::E_VALUE_TYPE_INVALID, $property));
        }
    }
}
