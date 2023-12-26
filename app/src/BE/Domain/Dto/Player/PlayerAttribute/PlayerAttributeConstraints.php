<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Player\PlayerAttribute;

abstract class PlayerAttributeConstraints
{
    public const ATT_MIN_MIN = 0;
    public const ATT_MIN_MAX = 6;

    public const ATT_MAX_MIN = 0;
    public const ATT_MAX_MAX = 6;

    public const DEF_MIN_MIN = 0;
    public const DEF_MIN_MAX = 6;

    public const DEF_MAX_MIN = 0;
    public const DEF_MAX_MAX = 6;
}
