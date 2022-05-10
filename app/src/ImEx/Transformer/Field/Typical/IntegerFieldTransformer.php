<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Transformer\Field\Typical;

use FAFI\src\ImEx\Transformer\Field\ImExFieldTransformer;
use FAFI\src\ImEx\Transformer\Specification\Field\Typical\IntegerSpecification;
use FAFI\exception\FafiException;

class IntegerFieldTransformer implements ImExFieldTransformer
{
    private IntegerSpecification $integerSpecification;

    public function __construct()
    {
        $this->integerSpecification = new IntegerSpecification();
    }


    /**
     * @param string $property
     * @param string $value
     *
     * @return int
     * @throws FafiException
     */
    public function fromStr(string $property, string $value): int
    {
        $value = ctype_digit($value) ? (int)$value : $value;

//        $this->integerSpecification->validate($property, $value);

        return $value;
    }
}
