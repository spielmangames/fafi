<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Geo\City;

use FAFI\src\BE\Domain\Dto\EntityInterface;

class City implements EntityInterface
{
    public const ENTITY = 'City';

    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly string $countryId,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCountryId(): string
    {
        return $this->countryId;
    }
}
