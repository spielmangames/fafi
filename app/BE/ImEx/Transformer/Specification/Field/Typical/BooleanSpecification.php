<?php

declare(strict_types=1);

namespace FAFI\BE\ImEx\Transformer\Specification\Field\Typical;

use FAFI\BE\ImEx\Transformer\Specification\Field\ImExFieldSpecification;
use FAFI\exception\FafiException;

class BooleanSpecification implements ImExFieldSpecification
{
    public const TRUE_FIELD = 'TRUE';
    public const FALSE_FIELD = 'FALSE';


    private const E_VALUE_TYPE_INVALID = '"%s" is not boolean.';


    public function validate(string $property, $value): void
    {
        $this->assertBool($property, $value);
    }

    /**
     * @param string $property
     * @param $value
     *
     * @return void
     * @throws FafiException
     */
    private function assertBool(string $property, $value): void
    {
        if (!is_bool($value)) {
            throw new FafiException(sprintf(self::E_VALUE_TYPE_INVALID, $property));
        }
    }
}
