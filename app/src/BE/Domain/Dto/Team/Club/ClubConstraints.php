<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Team\Club;

abstract class ClubConstraints
{
    public const NAME_MIN = 1;
    public const NAME_MAX = 32;

    public const FAFI_NAME_MIN = 1;
    public const FAFI_NAME_MAX = 32;

    public const FOUNDED_MIN = 1857;
    public const FOUNDED_MAX = 2024;
}
