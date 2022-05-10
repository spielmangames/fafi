<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Transformer\Field\Typical;

use FAFI\src\ImEx\Transformer\Specification\Field\Typical\StringSpecification;
use FAFI\exception\FafiException;

class StringFieldTransformer
{
    private StringSpecification $stringSpecification;

    public function __construct()
    {
        $this->stringSpecification = new StringSpecification();
    }


    /**
     * @param string $property
     * @param string $value
     *
     * @return string
     * @throws FafiException
     */
    public function fromStr(string $property, string $value): string
    {
//        $this->integerSpecification->validate($property, $value);

        return $value;
    }
}
