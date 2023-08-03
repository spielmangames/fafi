<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Team\Club;

use FAFI\src\BE\Domain\Dto\EntityInterface;
use FAFI\src\BE\Domain\Dto\Team\Team;

class Club extends Team implements EntityInterface
{
    public const ENTITY = 'Club';


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
