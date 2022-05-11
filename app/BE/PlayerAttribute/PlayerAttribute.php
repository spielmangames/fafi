<?php

namespace FAFI\BE\PlayerAttribute;

class PlayerAttribute
{
    public const ENTITY = 'Player Attribute';


    private ?int $id;

    protected ?int $playerId;
    protected ?int $positionId;

    protected ?int $attMin;
    protected ?int $attMax;
    protected ?int $defMin;
    protected ?int $defMax;


    public function __construct(
        ?int $id,

        ?int $playerId,
        ?int $positionId,

        ?int $attMin,
        ?int $attMax,
        ?int $defMin,
        ?int $defMax
    ) {
        $this->id = $id;

        $this->playerId = $playerId;
        $this->positionId = $positionId;

        $this->attMin = $attMin;
        $this->attMax = $attMax;
        $this->defMin = $defMin;
        $this->defMax = $defMax;
    }


    public function getId(): ?int
    {
        return $this->id;
    }


    public function setPlayerId(int $playerId): self
    {
        $this->playerId = $playerId;
        return $this;
    }

    public function getPlayerId(): ?int
    {
        return $this->playerId;
    }

    public function setPositionId(int $positionId): self
    {
        $this->positionId = $positionId;
        return $this;
    }

    public function getPositionId(): ?int
    {
        return $this->positionId;
    }


    public function setAttMin(int $attMin): self
    {
        $this->attMin = $attMin;
        return $this;
    }

    public function getAttMin(): ?int
    {
        return $this->attMin;
    }

    public function setAttMax(int $attMax): self
    {
        $this->attMax = $attMax;
        return $this;
    }

    public function getAttMax(): ?int
    {
        return $this->attMax;
    }

    public function setDefMin(int $defMin): self
    {
        $this->defMin = $defMin;
        return $this;
    }

    public function getDefMin(): ?int
    {
        return $this->defMin;
    }

    public function setDefMax(int $defMax): self
    {
        $this->defMax = $defMax;
        return $this;
    }

    public function getDefMax(): ?int
    {
        return $this->defMax;
    }
}
