<?php

namespace FAFI\src\GeoCountry;

class Country
{
    public const ENTITY = 'Country';


    private ?int $id;

    protected ?string $name;


    public function __construct(
        ?int $id,

        ?string $name
    ) {
        $this->id = $id;

        $this->name = $name;
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
