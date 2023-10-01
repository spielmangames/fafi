<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Player\Position;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;

class PositionData implements EntityDataInterface
{
    private ?int $id = null;

    private ?string $name = null;


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
