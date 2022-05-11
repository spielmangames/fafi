<?php

declare(strict_types=1);

namespace FAFI\BE\ImEx\Transformer\Specification\Field;

use FAFI\BE\ImEx\Transformer\Specification\Field\Player\PlayerFootSpecification;
use FAFI\BE\ImEx\Transformer\Specification\Field\Typical\BooleanSpecification;
use FAFI\BE\ImEx\Transformer\Specification\Field\Typical\IntegerSpecification;
use FAFI\BE\ImEx\Transformer\Specification\Field\Typical\StringSpecification;
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
            case StringSpecification::class:
                return new StringSpecification();

            case PlayerFootSpecification::class:
                return new PlayerFootSpecification();

            default:
                throw new FafiException(sprintf(FafiException::E_CLASS_ABSENT, $class));
        }
    }
}
