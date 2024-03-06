<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Schema\FileSchema\Entity;

class PlayerAttributeFileSchema
{
    public const ATTRIBUTE_WRAP_OPEN = '[';
    public const ATTRIBUTE_WRAP_CLOSE = ']';
    public const ATTRIBUTE_NAME_VALUE_SEPARATOR = ':';
    public const ATTRIBUTE_VALUES_SEPARATOR = ';';
    public const ATTRIBUTE_VALUE_SEPARATOR = '=';
    public const ATTRIBUTE_VALUE_RANGE_SEPARATOR = '.';

    public const ATTRIBUTE_NAME_ATT = 'a';
    public const ATTRIBUTE_NAME_DEF = 'd';
    public const ATTRIBUTE_NAME_MAP = [
        'att' => self::ATTRIBUTE_NAME_ATT,
        'def' => self::ATTRIBUTE_NAME_DEF,
    ];

}
