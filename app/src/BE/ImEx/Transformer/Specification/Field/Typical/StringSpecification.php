<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical;

use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\ImExFieldSpecification;

class StringSpecification implements ImExFieldSpecification
{
    private const E_VALUE_TYPE_INVALID = 'Property "%s" is not string.';


    public function validate(string $property, $value): void
    {
        $this->assertStr($property, $value);
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
