<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Schema\File;

class CityFileSchema extends AbstractFileSchema
{
    public const NAME = 'name';

//    public const REGION = 'region';
//    public const COUNTRY = 'country';


    public const FILE_HEADER = [
        self::ID,

        self::NAME,
//        self::REGION,
//        self::COUNTRY,
    ];
}
