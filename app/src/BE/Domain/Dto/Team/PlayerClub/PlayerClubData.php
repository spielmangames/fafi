<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Team\PlayerClub;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;

class PlayerClubData implements EntityDataInterface
{
    private ?int $id = null;

    private ?int $clubId = null;
    private ?int $num = null;
    private ?int $playerId = null;


    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function setClubId(?int $clubId): self
    {
        $this->clubId = $clubId;
        return $this;
    }

    public function getClubId(): ?int
    {
        return $this->clubId;
    }

    public function setNum(?int $num): self
    {
        $this->num = $num;
        return $this;
    }

    public function getNum(): ?int
    {
        return $this->num;
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
}
