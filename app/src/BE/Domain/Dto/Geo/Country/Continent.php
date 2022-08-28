<?php

namespace FAFI\src\BE\Domain\Dto\Geo\Country;

interface Continent
{
    public const AFRICA = 'Africa';
    public const AMERICA = 'America';
    public const ASIA = 'Asia';
    public const EUROPE = 'Europe';

    public const SUPPORTED = [
        self::AFRICA,
        self::AMERICA,
        self::ASIA,
        self::EUROPE,
    ];
}
