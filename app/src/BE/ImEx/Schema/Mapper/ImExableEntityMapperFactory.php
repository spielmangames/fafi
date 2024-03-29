<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Schema\Mapper;

use FAFI\exception\FafiException;

class ImExableEntityMapperFactory
{
    /**
     * @param string $class
     *
     * @return ImExableEntityMapperInterface
     * @throws FafiException
     */
    public function create(string $class): ImExableEntityMapperInterface
    {
        return match ($class) {
            // Geo specific
            CountryMapper::class => new CountryMapper(),
            CityMapper::class => new CityMapper(),

            // Team specific
            ClubMapper::class => new ClubMapper(),

            // Player specific
            PositionMapper::class => new PositionMapper(),
            PlayerMapper::class => new PlayerMapper(),
            PlayerAttributeMapper::class => new PlayerAttributeMapper(),
            PlayerIntegrationMapper::class => new PlayerIntegrationMapper(),

            default => throw new FafiException(sprintf(FafiException::E_CLASS_ABSENT, $class)),
        };
    }
}
