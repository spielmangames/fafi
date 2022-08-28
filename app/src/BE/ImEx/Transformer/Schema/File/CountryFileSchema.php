<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Schema\File;

class CountryFileSchema extends AbstractFileSchema
{
    public const NAME = 'name';
//    public const CODE = 'code';
    public const CONTINENT = 'continent';


    public const FILE_HEADER = [
        self::ID,

        self::NAME,
//        self::CODE,
        self::CONTINENT,
    ];
}
