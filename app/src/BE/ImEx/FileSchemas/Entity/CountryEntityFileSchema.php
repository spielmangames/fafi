<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\FileSchemas\Entity;

class CountryEntityFileSchema extends AbstractEntityFileSchema
{
    public const NAME = 'name';
    public const CONTINENT = 'continent';


    public const HEADER = [
        self::ID,

        self::NAME,
        self::CONTINENT,
    ];
}
