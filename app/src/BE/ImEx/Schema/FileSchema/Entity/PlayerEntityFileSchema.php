<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Schema\FileSchema\Entity;

class PlayerEntityFileSchema extends AbstractEntityFileSchema
{
    public const NAME = 'name';
    public const PARTICLE = 'particle';
    public const SURNAME = 'surname';
    public const FAFI_SURNAME = 'fafi_surname';

    public const NATIONALITY = 'nationality';

    public const FOOT = 'foot';
    public const HEIGHT = 'height';
    public const IS_FRAGILE = 'is_fragile';

    public const ATTRIBUTES = 'attributes';

    public const TMARKT = 'tmarkt';


    public const HEADER = [
        self::ID,

        self::NATIONALITY,

        self::NAME,
        self::PARTICLE,
        self::SURNAME,
        self::FAFI_SURNAME,

        self::ATTRIBUTES,

        self::FOOT,
        self::HEIGHT,
        self::IS_FRAGILE,

        self::TMARKT,
    ];
}
