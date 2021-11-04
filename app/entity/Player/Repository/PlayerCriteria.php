<?php

namespace FAFI\entity\Player\Repository;

use FAFI\entity\EntityCriteriaInterface;

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