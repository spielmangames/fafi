<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Clients;

use FAFI\exception\FafiException;

class EntityClientFactory
{
    /**
     * @param string $class
     *
     * @return EntityClientInterface
     * @throws FafiException
     */
    public function create(string $class): EntityClientInterface
    {
        return match ($class) {
            CountryClient::class => new CountryClient(),
            CityClient::class => new CityClient(),

            ClubClient::class => new ClubClient(),

            PositionClient::class => new PositionClient(),
            PlayerClient::class => new PlayerClient(),
            PlayerAttributeClient::class => new PlayerAttributeClient(),

            default => throw new FafiException(sprintf(FafiException::E_CLASS_ABSENT, $class)),
        };
    }
}
