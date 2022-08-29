<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Geo\Country;

use FAFI\src\BE\Domain\Dto\EntityInterface;

class Country implements EntityInterface
{
    public const ENTITY = 'Country';


    private ?int $id = null;

    protected ?string $name = null;
    protected ?string $continent = null;


    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setContinent(string $continent): self
    {
        $this->continent = $continent;
        return $this;
    }

    public function getContinent(): string
    {
        return $this->continent;
    }


    public function __toString(): string
    {
        return self::ENTITY;
    }
}
