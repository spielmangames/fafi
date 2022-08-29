<?php

namespace FAFI\src\BE\Domain\Dto\Geo\Country;

class CountryConstraints
{
    public const NAME_MIN = 1;
    public const NAME_MAX = 32;

    public const CONTINENTS_SUPPORTED = Continent::SUPPORTED;
}
