<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Field;

use FAFI\src\BE\Domain\Persistence\DataValidator;

abstract class AbstractFieldSpecification
{
    protected DataValidator $dataValidator;

    public function __construct()
    {
        $this->dataValidator = new DataValidator();
    }
}
