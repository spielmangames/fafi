<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Schema\FileSchema\Entity;

class PositionEntityFileSchema extends AbstractEntityFileSchema
{
    public const NAME = 'name';


    public const HEADER = [
        self::ID,

        self::NAME,
    ];
}
