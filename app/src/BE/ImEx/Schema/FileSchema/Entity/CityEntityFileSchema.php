<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Schema\FileSchema\Entity;

class CityEntityFileSchema extends AbstractEntityFileSchema
{
    public const NAME = 'name';
    public const COUNTRY = 'country';


    public const HEADER = [
        self::ID,

        self::NAME,
        self::COUNTRY,
    ];
}
