<?php

declare(strict_types=1);

namespace FAFI\entity\ImEx\Transformer\Field\Specification\Typical;

use FAFI\exception\FafiException;

class IntegerSpecification
{
    private const E_VALUE_NOT_INT = 'Property %s must be integer.';


    /**
     * @param string $property
     * @param $value
     *
     * @return void
     * @throws FafiException
     */
    public function assertInt(string $property, $value): void
    {
        if (!is_int($value)) {
            throw new FafiException(sprintf(self::E_VALUE_NOT_INT, $property));
        }
    }
}
