<?php

declare(strict_types=1);

namespace FAFI\entity\ImEx\Transformer\Specification\Field;

interface ImExFieldSpecification
{
    public function validate(string $property, $value): bool;
}
