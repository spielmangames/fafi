<?php

declare(strict_types=1);

namespace FAFI\entity\ImEx\Transformer\Specification\Field\Typical;

use FAFI\entity\ImEx\Transformer\Specification\Field\ImExFieldSpecification;
use FAFI\exception\FafiException;

class StringSpecification implements ImExFieldSpecification
{
    private const E_VALUE_TYPE_INVALID = 'Property %s must be string.';


    public function validate(string $property, $value): bool
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
    private function assertStr(string $property, $value): void
    {
        if (!is_string($value)) {
            throw new FafiException(sprintf(self::E_VALUE_TYPE_INVALID, $property));
        }
    }
}
