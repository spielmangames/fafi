<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\FileSchemas\Entity\Mapper;

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
            CountryMapper::class => new CountryMapper(),
            CityMapper::class => new CityMapper(),

            default => throw new FafiException(sprintf(FafiException::E_CLASS_ABSENT, $class)),
        };
    }
}
