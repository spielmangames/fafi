<?php

namespace FAFI\src\BE\Domain\Persistence\Player\Player;

class PlayersFilter
{
    private const DEFAULT_READ_LIMIT = 50;


    private ?array $playerIds;

    private int $offset;
    private int $limit;


    public function __construct(
        ?array $playerIds = null,
        int $offset = 0,
        int $limit = self::DEFAULT_READ_LIMIT
    ) {
        $this->playerIds = $playerIds;

        $this->offset = $offset;
        $this->limit = $limit;
    }


    public function getPlayerIds(): ?array
    {
        return $this->playerIds;
    }


    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}
