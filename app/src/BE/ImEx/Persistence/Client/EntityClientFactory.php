<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Persistence\Client;

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
        switch ($class) {
            case CountryClient::class:
                return new CountryClient();

            case PositionClient::class:
                return new PositionClient();
            case PlayerClient::class:
                return new PlayerClient();
            case PlayerAttributeClient::class:
                return new PlayerAttributeClient();
        }

        throw new FafiException(sprintf(FafiException::E_CLASS_ABSENT, $class));
    }
}
