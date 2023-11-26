<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Team\PlayerClub;

use FAFI\src\BE\Domain\Dto\EntityInterface;

class PlayerClub implements EntityInterface
{
    public const ENTITY = 'Club Squad';

    public function __construct(
        private readonly int $id,
        private readonly int $clubId,
        private readonly int $num,
        private readonly int $playerId,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function getClubId(): int
    {
        return $this->clubId;
    }

    public function getNum(): int
    {
        return $this->num;
    }

    public function getPlayerId(): int
    {
        return $this->playerId;
    }
}
