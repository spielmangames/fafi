<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Persistence\Geo\City\CityDataHydrator;
use FAFI\src\BE\Domain\Persistence\Geo\Country\CountryDataHydrator;
use FAFI\src\BE\Domain\Persistence\Player\Player\PlayerDataHydrator;
use FAFI\src\BE\Domain\Persistence\Player\PlayerAttribute\PlayerAttributeDataHydrator;
use FAFI\src\BE\Domain\Persistence\Player\Position\PositionDataHydrator;

class EntityDataHydratorFactory
{
    /**
     * @param string $class
     *
     * @return EntityDataHydratorInterface
     * @throws FafiException
     */
    public function create(string $class): EntityDataHydratorInterface
    {
        return match ($class) {
            CountryDataHydrator::class => new CountryDataHydrator(),
            CityDataHydrator::class => new CityDataHydrator(),

            PositionDataHydrator::class => new PositionDataHydrator(),
            PlayerDataHydrator::class => new PlayerDataHydrator(),
            PlayerAttributeDataHydrator::class => new PlayerAttributeDataHydrator(),

            default => throw new FafiException(sprintf(FafiException::E_CLASS_ABSENT, $class)),
        };
    }
}
