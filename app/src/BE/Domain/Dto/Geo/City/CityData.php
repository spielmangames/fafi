<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Geo\City;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;

class CityData implements EntityDataInterface
{
    private ?int $id = null;

    protected ?string $name = null;
    protected ?int $countryId = null;


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

    public function setCountryId(int $countryId): self
    {
        $this->countryId = $countryId;
        return $this;
    }

    public function getCountryId(): ?int
    {
        return $this->countryId;
    }
}
