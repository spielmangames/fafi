<?php

declare(strict_types=1);

namespace FAFI\entity\ImEx\Transformer\Field\Typical;

use FAFI\entity\ImEx\Transformer\Field\Specification\Typical\IntegerSpecification;
use FAFI\exception\FafiException;

class IntFieldTransformer
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

        $this->integerSpecification->assertInt($property, $value);

        return $value;
    }
}
