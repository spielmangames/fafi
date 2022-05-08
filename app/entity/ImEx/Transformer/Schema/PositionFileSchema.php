<?php

namespace FAFI\entity\ImEx\Transformer\Schema;

class PositionFileSchema extends AbstractFileSchema
{
    public const NAME = 'name';


    public const FILE_HEADER = [
        self::ID,

        self::NAME,
    ];
}
