<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Geo\Country;

use FAFI\src\BE\Domain\Dto\EntityInterface;

class Country implements EntityInterface
{
    public const ENTITY = 'Country';

    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly string $continent,
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

    public function getContinent(): string
    {
        return $this->continent;
    }
}
