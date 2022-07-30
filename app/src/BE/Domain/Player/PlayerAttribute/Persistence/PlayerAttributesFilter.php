<?php

namespace FAFI\src\BE\Domain\Player\PlayerAttribute\Persistence;

class PlayerAttributesFilter
{
    private const DEFAULT_READ_LIMIT = 50;


    private ?array $positionIds;

    private int $offset;
    private int $limit;


    public function __construct(
        ?array $positionIds = null,
        int $offset = 0,
        int $limit = self::DEFAULT_READ_LIMIT
    ) {
        $this->positionIds = $positionIds;

        $this->offset = $offset;
        $this->limit = $limit;
    }


    public function getPositionIds(): ?array
    {
        return $this->positionIds;
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
