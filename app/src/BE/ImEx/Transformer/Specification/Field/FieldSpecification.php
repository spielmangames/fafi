<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Field;

use FAFI\exception\FafiException;

interface FieldSpecification
{
    /**
     * @param string $property
     * @param $value
     *
     * @return void
     * @throws FafiException
     */
    public function validate(string $property, $value): void;
}
