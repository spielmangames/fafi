<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Field;

use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Player\PlayerAttributesSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Player\PlayerFootSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\BooleanSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IntegerSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\StringSpecification;

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
            // typical
            case BooleanSpecification::class:
                return new BooleanSpecification();
            case IntegerSpecification::class:
                return new IntegerSpecification();
            case StringSpecification::class:
                return new StringSpecification();

            // Player
            case PlayerFootSpecification::class:
                return new PlayerFootSpecification();
            case PlayerAttributesSpecification::class:
                return new PlayerAttributesSpecification();
        }

        throw new FafiException(sprintf(FafiException::E_CLASS_ABSENT, $class));
    }
}
