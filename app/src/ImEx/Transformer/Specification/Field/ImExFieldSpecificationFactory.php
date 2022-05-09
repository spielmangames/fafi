<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Transformer\Specification\Field;

use FAFI\src\ImEx\Transformer\Specification\Field\Typical\BooleanSpecification;
use FAFI\src\ImEx\Transformer\Specification\Field\Typical\IntegerSpecification;
use FAFI\src\ImEx\Transformer\Specification\Field\Typical\OneOfSpecification;
use FAFI\src\ImEx\Transformer\Specification\Field\Typical\StringSpecification;
use FAFI\exception\FafiException;

class ImExFieldSpecificationFactory
{
    /**
     * @param string $class
     *
     * @return ImExFieldSpecification
     * @throws FafiException
     */
    public function create(string $class): ImExFieldSpecification
    {
        switch ($class) {
            case BooleanSpecification::class:
                return new BooleanSpecification();
            case IntegerSpecification::class:
                return new IntegerSpecification();
            case OneOfSpecification::class:
                return new OneOfSpecification();
            case StringSpecification::class:
                return new StringSpecification();

            default:
                throw new FafiException(sprintf(FafiException::E_CLASS_ABSENT, $class));
        }
    }
}
