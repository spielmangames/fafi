<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Schema\FileSchema\Entity;

class PlayerAttributeEntityFileSchema extends AbstractEntityFileSchema
{
    public const PLAYER = 'player';
    public const POSITION = 'position';

    public const ATT_MIN = 'att_min';
    public const ATT_MAX = 'att_max';
    public const DEF_MIN = 'def_min';
    public const DEF_MAX = 'def_max';


    public const HEADER = [
        self::ID,

        self::PLAYER,
        self::POSITION,

        self::ATT_MIN,
        self::ATT_MAX,
        self::DEF_MIN,
        self::DEF_MAX,
    ];
}
