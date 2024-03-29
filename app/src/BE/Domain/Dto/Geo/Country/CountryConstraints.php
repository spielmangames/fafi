<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Geo\Country;

abstract class CountryConstraints
{
    public const NAME_MIN = 1;
    public const NAME_MAX = 32;

    public const CONTINENTS_SUPPORTED = ContinentEnum::SUPPORTED;
}
