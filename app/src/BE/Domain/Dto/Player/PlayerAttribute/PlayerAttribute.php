<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Player\PlayerAttribute;

use FAFI\src\BE\Domain\Dto\EntityInterface;

class PlayerAttribute implements EntityInterface
{
    public const ENTITY = 'Player Attribute';

    public function __construct(
        private readonly int $id,
        private readonly int $playerId,
        private readonly int $positionId,
        private readonly int $attMin,
        private readonly int $attMax,
        private readonly int $defMin,
        private readonly int $defMax,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPlayerId(): int
    {
        return $this->playerId;
    }

    public function getPositionId(): int
    {
        return $this->positionId;
    }

    public function getAttMin(): int
    {
        return $this->attMin;
    }

    public function getAttMax(): int
    {
        return $this->attMax;
    }

    public function getDefMin(): int
    {
        return $this->defMin;
    }

    public function getDefMax(): int
    {
        return $this->defMax;
    }
}
