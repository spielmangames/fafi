<?php

namespace FAFI\src\BE\Domain\Geo\Country;

use FAFI\src\BE\Domain\EntityInterface;

class Country implements EntityInterface
{
    public const ENTITY = 'Country';


    private ?int $id = null;

    protected ?string $name = null;


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


    public function __toString(): string
    {
        return self::ENTITY;
    }
}
