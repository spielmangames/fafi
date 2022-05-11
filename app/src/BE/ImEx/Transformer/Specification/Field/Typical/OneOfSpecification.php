<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical;

use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\ImExFieldSpecification;

abstract class OneOfSpecification implements ImExFieldSpecification
{
    private const E_VALUE_TYPE_INVALID = 'Property "%s" value is not allowed.';

    public array $allowed;


    public function validate(string $property, $value): void
    {
        $this->assertInList($property, $value);
    }

    /**
     * @param string $property
     * @param $value
     *
     * @return void
     * @throws FafiException
     */
    private function assertInList(string $property, $value): void
    {
        if (!in_array($value, $this->allowed)) {
            throw new FafiException(sprintf(self::E_VALUE_TYPE_INVALID, $property));
        }
    }
}
