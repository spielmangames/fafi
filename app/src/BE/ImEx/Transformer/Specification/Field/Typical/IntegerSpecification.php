<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical;

use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\ImExFieldSpecification;

class IntegerSpecification implements ImExFieldSpecification
{
    private const E_VALUE_TYPE_INVALID = 'Property "%s" is not integer.';


    public function validate(string $property, $value): void
    {
        $this->assertInt($property, $value);
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
