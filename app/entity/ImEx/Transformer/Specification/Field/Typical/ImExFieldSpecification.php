<?php

declare(strict_types=1);

namespace FAFI\entity\ImEx\Transformer\Specification\Field\Typical;

interface ImExFieldSpecification
{
    public function validate(): bool;
}
