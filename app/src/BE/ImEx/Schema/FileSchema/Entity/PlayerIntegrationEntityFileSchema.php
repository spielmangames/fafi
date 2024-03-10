<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Schema\FileSchema\Entity;

class PlayerIntegrationEntityFileSchema extends AbstractEntityFileSchema
{
    public const PLAYER = 'player';
    public const TMARKT = 'tmarkt';


    public const HEADER = [
        self::ID,

        self::PLAYER,
        self::TMARKT,
    ];
}
