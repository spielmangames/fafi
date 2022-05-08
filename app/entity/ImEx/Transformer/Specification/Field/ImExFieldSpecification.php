<?php

declare(strict_types=1);

namespace FAFI\entity\ImEx\Transformer\Specification\Field;

use FAFI\exception\FafiException;

interface ImExFieldSpecification
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
