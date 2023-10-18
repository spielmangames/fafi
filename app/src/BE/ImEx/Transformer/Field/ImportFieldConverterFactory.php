<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Field;

use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\Transformer\Field\Geo\CountryNameToIdFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Player\PlayerAttributesFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\BooleanFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\IntegerFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\StringFieldConverter;

class ImportFieldConverterFactory
{
    /**
     * @param string $class
     *
     * @return ImportFieldConverter
     * @throws FafiException
     */
    public function create(string $class): ImportFieldConverter
    {
        return match ($class) {
            // typical
            BooleanFieldConverter::class => new BooleanFieldConverter(),
            IntegerFieldConverter::class => new IntegerFieldConverter(),
            StringFieldConverter::class => new StringFieldConverter(),

            // Geo specific
            CountryNameToIdFieldConverter::class => new CountryNameToIdFieldConverter(),

            // Player specific
            PlayerAttributesFieldConverter::class => new PlayerAttributesFieldConverter(),

            default => throw new FafiException(sprintf(FafiException::E_CLASS_ABSENT, $class)),
        };
    }
}
