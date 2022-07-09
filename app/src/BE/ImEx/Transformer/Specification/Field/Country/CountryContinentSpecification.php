<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Field\Country;

use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\OneOfSpecification;

class CountryContinentSpecification extends OneOfSpecification
{
    public const AFRICA = 'Africa';
    public const AMERICA = 'America';
    public const ASIA = 'Asia';
    public const EUROPE = 'Europe';

    public array $allowed = [
        self::AFRICA,
        self::AMERICA,
        self::ASIA,
        self::EUROPE,
    ];
}
