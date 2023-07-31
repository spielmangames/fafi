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
        switch ($class) {
            case CountryConfig::class:
                return new CountryConfig();
            case CityConfig::class:
                return new CityConfig();

            case ClubConfig::class:
                return new ClubConfig();

            case PositionConfig::class:
                return new PositionConfig();
            case PlayerConfig::class:
                return new PlayerConfig();
        }

        throw new FafiException(sprintf(FafiException::E_CLASS_ABSENT, $class));
    }
}
