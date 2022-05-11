<?php

namespace FAFI\src\BE\GeoCountry;

use FAFI\src\BE\Structure\EntityInterface;

class Country implements EntityInterface
{
    public const ENTITY = 'Country';


    private ?int $id;

    protected ?string $name;


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
}
