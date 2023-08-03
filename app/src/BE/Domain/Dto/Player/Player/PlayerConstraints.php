<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Player\Player;

abstract class PlayerConstraints
{
    public const NAME_MIN = 0;
    public const NAME_MAX = 32;

    public const PARTICLE_MIN = 0;
    public const PARTICLE_MAX = 8;

    public const SURNAME_MIN = 1;
    public const SURNAME_MAX = 32;

    public const FAFI_SURNAME_MIN = 1;
    public const FAFI_SURNAME_MAX = 32;


    public const HEIGHT_MIN = 111;
    public const HEIGHT_MAX = 222;

    public const FOOT_SUPPORTED = Foot::SUPPORTED;
}
