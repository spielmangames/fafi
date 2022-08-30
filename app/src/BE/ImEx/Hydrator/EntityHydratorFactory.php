<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Hydrator;

use FAFI\exception\FafiException;

class EntityHydratorFactory
{
    /**
     * @param string $class
     *
     * @return EntityHydratorInterface
     * @throws FafiException
     */
    public function create(string $class): EntityHydratorInterface
    {
        switch ($class) {
            case CountryHydrator::class:
                return new CountryHydrator();
            case CityHydrator::class:
                return new CityHydrator();

            case PositionHydrator::class:
                return new PositionHydrator();
            case PlayerHydrator::class:
                return new PlayerHydrator();
            case PlayerAttributeHydrator::class:
                return new PlayerAttributeHydrator();
        }

        throw new FafiException(sprintf(FafiException::E_CLASS_ABSENT, $class));
    }
}
