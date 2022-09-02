<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Player\Player;

interface Foot
{
    public const LEFT = 'L';
    public const RIGHT = 'R';

    public const SUPPORTED = [
        self::LEFT,
        self::RIGHT,
    ];
}