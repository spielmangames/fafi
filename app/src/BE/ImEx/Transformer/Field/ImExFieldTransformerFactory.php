<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Field;

use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\Transformer\Field\Player\PlayerAttributesFieldTransformer;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\BooleanFieldTransformer;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\IntegerFieldTransformer;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\StringFieldTransformer;

class ImExFieldTransformerFactory
{
    /**
     * @param string $class
     *
     * @return ImportFieldTransformer
     * @throws FafiException
     */
    public function create(string $class): ImportFieldTransformer
    {
        switch ($class) {
            case BooleanFieldTransformer::class:
                return new BooleanFieldTransformer();
            case IntegerFieldTransformer::class:
                return new IntegerFieldTransformer();
            case StringFieldTransformer::class:
                return new StringFieldTransformer();

            case PlayerAttributesFieldTransformer::class:
                return new PlayerAttributesFieldTransformer();

            default:
                throw new FafiException(sprintf(FafiException::E_CLASS_ABSENT, $class));
        }
    }
}
