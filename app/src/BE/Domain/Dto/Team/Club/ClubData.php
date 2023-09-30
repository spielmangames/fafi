<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Team\Club;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;

class ClubData implements EntityDataInterface
{
    private ?int $id = null;

    protected ?string $name = null;
    protected ?string $fafiName = null;
    protected ?int $cityId = null;
    protected ?int $founded = null;


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

    public function setFafiName(string $fafiName): self
    {
        $this->fafiName = $fafiName;
        return $this;
    }

    public function getFafiName(): ?string
    {
        return $this->fafiName;
    }

    public function setCityId(int $cityId): self
    {
        $this->cityId = $cityId;
        return $this;
    }

    public function getCityId(): ?int
    {
        return $this->cityId;
    }

    public function setFounded(int $founded): self
    {
        $this->founded = $founded;
        return $this;
    }

    public function getFounded(): ?int
    {
        return $this->founded;
    }
}
