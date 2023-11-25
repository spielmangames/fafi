<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Player\PlayerAttribute;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;

class PlayerAttributeData implements EntityDataInterface
{
    private ?int $id = null;

    protected ?int $playerId = null;
    protected ?int $positionId = null;

    protected ?int $attMin = null;
    protected ?int $attMax = null;
    protected ?int $defMin = null;
    protected ?int $defMax = null;


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

    public function setPositionId(?int $positionId): self
    {
        $this->positionId = $positionId;
        return $this;
    }

    public function getPositionId(): ?int
    {
        return $this->positionId;
    }


    public function setAttMin(?int $attMin): self
    {
        $this->attMin = $attMin;
        return $this;
    }

    public function getAttMin(): ?int
    {
        return $this->attMin;
    }

    public function setAttMax(?int $attMax): self
    {
        $this->attMax = $attMax;
        return $this;
    }

    public function getAttMax(): ?int
    {
        return $this->attMax;
    }

    public function setDefMin(?int $defMin): self
    {
        $this->defMin = $defMin;
        return $this;
    }

    public function getDefMin(): ?int
    {
        return $this->defMin;
    }

    public function setDefMax(?int $defMax): self
    {
        $this->defMax = $defMax;
        return $this;
    }

    public function getDefMax(): ?int
    {
        return $this->defMax;
    }
}
