<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\FileSchemas\Entity;

class ClubEntityFileSchema extends AbstractEntityFileSchema
{
    public const NAME = 'name';

//    public const REGION = 'region';
//    public const COUNTRY = 'country';


    public const HEADER = [
        self::ID,

        self::NAME,
//        self::REGION,
//        self::COUNTRY,
    ];
}
