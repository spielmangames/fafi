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
            // Geo
            CountryConfig::class => new CountryConfig(),
            CityConfig::class => new CityConfig(),

            // Team
            ClubConfig::class => new ClubConfig(),

            // Skills
            PositionConfig::class => new PositionConfig(),

            // Player
            PlayerConfig::class => new PlayerConfig(),
            PlayerAttributeConfig::class => new PlayerAttributeConfig(),


            default => throw new FafiException(sprintf(FafiException::E_CLASS_ABSENT, $class)),
        };
    }
}
