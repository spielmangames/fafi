<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Schema\File;

class PositionFileSchema extends AbstractFileSchema
{
    public const NAME = 'name';


    public const FILE_HEADER = [
        self::ID,

        self::NAME,
    ];
}
