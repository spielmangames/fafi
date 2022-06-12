<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical;

use FAFI\exception\EntityErr;
use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\ImExFieldSpecification;

class StringSpecification implements ImExFieldSpecification
{
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
            throw new FafiException(sprintf(EntityErr::VALUE_TYPE_INVALID_STR, $property));
        }
    }
}
