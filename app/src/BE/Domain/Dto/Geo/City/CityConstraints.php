<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Geo\City;

abstract class CityConstraints
{
    public const NAME_MIN = 1;
    public const NAME_MAX = 32;
}
