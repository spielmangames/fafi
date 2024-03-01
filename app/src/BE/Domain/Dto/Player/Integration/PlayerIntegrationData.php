<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Player\Integration;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;

class PlayerIntegrationData implements EntityDataInterface
{
    private ?int $id = null;

    protected ?int $playerId = null;
    protected ?string $tmarkt = null;


    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function setPlayerId(?int $playerId): self
    {
        $this->playerId = $playerId;
        return $this;
    }

    public function getPlayerId(): ?int
    {
        return $this->playerId;
    }

    public function setTmarkt(?string $tmarkt): self
    {
        $this->tmarkt = $tmarkt;
        return $this;
    }

    public function getTmarkt(): ?string
    {
        return $this->tmarkt;
    }
}
