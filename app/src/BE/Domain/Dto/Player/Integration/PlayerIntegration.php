<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Player\Integration;

use FAFI\src\BE\Domain\Dto\EntityInterface;

class PlayerIntegration implements EntityInterface
{
    public const ENTITY = 'Player Integration';

    public function __construct(
        private readonly int $id,
        private readonly int $playerId,
        private readonly string $tmarkt,
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

    public function getTmarkt(): string
    {
        return $this->tmarkt;
    }
}
