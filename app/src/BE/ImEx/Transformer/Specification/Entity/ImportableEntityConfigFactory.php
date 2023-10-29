<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

use FAFI\exception\FafiException;

class ImportableEntityConfigFactory
{
    /**
     * @param string $class
     *
     * @return ImportableEntityConfig
     * @throws FafiException
     */
    public function create(string $class): ImportableEntityConfig
    {
        return match ($class) {
            // Geo specific
            CountryConfig::class => new CountryConfig(),
            CityConfig::class => new CityConfig(),

            // Team specific
            ClubConfig::class => new ClubConfig(),

            // Player specific
            PositionConfig::class => new PositionConfig(),
            PlayerConfig::class => new PlayerConfig(),
            PlayerAttributeConfig::class => new PlayerAttributeConfig(),

            default => throw new FafiException(sprintf(FafiException::E_CLASS_ABSENT, $class)),
        };
    }
}
