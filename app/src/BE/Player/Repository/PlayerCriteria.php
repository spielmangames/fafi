<?php

namespace FAFI\src\BE\Player\Repository;

use FAFI\src\BE\Structure\Repository\EntityCriteriaInterface;

class PlayerCriteria implements EntityCriteriaInterface
{
    private ?array $playerIds;
    private ?string $statuses;

    /**
     * @param array|null $playerIds
     * @param string|null $statuses
     */
    public function __construct(
        ?array $playerIds = null,
        ?string $statuses = null
    ) {
        $this->playerIds = $playerIds;
        $this->statuses = $statuses;
    }


    public function getIds(): ?array
    {
        return $this->playerIds;
    }


    public function isEmpty(): bool
    {
        return empty($this->playerIds) && empty($this->statuses);
    }
}
