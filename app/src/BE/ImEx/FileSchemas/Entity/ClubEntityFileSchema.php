<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\FileSchemas\Entity;

class ClubEntityFileSchema extends AbstractEntityFileSchema
{
    public const NAME = 'name';
    public const FAFI_NAME = 'fafi_name';
    public const CITY = 'city';
    public const FOUNDED = 'founded';


    public const HEADER = [
        self::ID,

        self::NAME,
        self::FAFI_NAME,
        self::CITY,
        self::FOUNDED,
    ];
}
