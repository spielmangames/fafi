<?php

declare(strict_types=1);

namespace FAFI\entity\ImEx\Transformer\Specification\Field;

use FAFI\entity\ImEx\Transformer\Specification\Field\Typical\BooleanSpecification;
use FAFI\entity\ImEx\Transformer\Specification\Field\Typical\IntegerSpecification;
use FAFI\entity\ImEx\Transformer\Specification\Field\Typical\OneOfSpecification;
use FAFI\entity\ImEx\Transformer\Specification\Field\Typical\StringSpecification;
use FAFI\exception\FafiException;

class ImExFieldSpecificationFactory
{
    private const E_SPECIFICATION_ABSENT = 'Specification class "%s" is absent.';


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
                throw new FafiException(sprintf(self::E_SPECIFICATION_ABSENT, $class));
        }
    }
}
