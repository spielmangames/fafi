<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Field;

use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\Transformer\Field\Player\PlayerAttributesFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\BooleanFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\IntegerFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\StringFieldConverter;

class ImExFieldConverterFactory
{
    /**
     * @param string $class
     *
     * @return ImportFieldConverter
     * @throws FafiException
     */
    public function create(string $class): ImportFieldConverter
    {
        switch ($class) {
            case BooleanFieldConverter::class:
                return new BooleanFieldConverter();
            case IntegerFieldConverter::class:
                return new IntegerFieldConverter();
            case StringFieldConverter::class:
                return new StringFieldConverter();

            case PlayerAttributesFieldConverter::class:
                return new PlayerAttributesFieldConverter();

            default:
                throw new FafiException(sprintf(FafiException::E_CLASS_ABSENT, $class));
        }
    }
}
