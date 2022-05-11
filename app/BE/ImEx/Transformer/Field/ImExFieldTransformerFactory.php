<?php

declare(strict_types=1);

namespace FAFI\BE\ImEx\Transformer\Field;

use FAFI\exception\FafiException;
use FAFI\BE\ImEx\Transformer\Field\Typical\BooleanFieldTransformer;
use FAFI\BE\ImEx\Transformer\Field\Typical\IntegerFieldTransformer;
use FAFI\BE\ImEx\Transformer\Field\Typical\StringFieldTransformer;

class ImExFieldTransformerFactory
{
    /**
     * @param string $class
     *
     * @return ImExFieldTransformer
     * @throws FafiException
     */
    public function create(string $class): ImExFieldTransformer
    {
        switch ($class) {
            case BooleanFieldTransformer::class:
                return new BooleanFieldTransformer();
            case IntegerFieldTransformer::class:
                return new IntegerFieldTransformer();
            case StringFieldTransformer::class:
                return new StringFieldTransformer();

            default:
                throw new FafiException(sprintf(FafiException::E_CLASS_ABSENT, $class));
        }
    }
}
