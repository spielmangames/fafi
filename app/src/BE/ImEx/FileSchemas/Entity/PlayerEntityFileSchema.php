<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\FileSchemas\Entity;

class PlayerEntityFileSchema extends AbstractEntityFileSchema
{
    public const NAME = 'name';
    public const PARTICLE = 'particle';
    public const SURNAME = 'surname';
    public const FAFI_SURNAME = 'fafi_surname';

    public const HEIGHT = 'height';
    public const FOOT = 'foot';
    public const INJURE_FACTOR = 'injure_factor';

    public const ATTRIBUTES = 'attributes';


    public const HEADER = [
        self::ID,

        self::NAME,
        self::PARTICLE,
        self::SURNAME,
        self::FAFI_SURNAME,

        self::HEIGHT,
        self::FOOT,
        self::INJURE_FACTOR,

        self::ATTRIBUTES,
    ];
}