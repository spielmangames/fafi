<?php

namespace FAFI\entity\Position\Repository;

use FAFI\entity\Structure\Repository\EntityCriteriaInterface;

class PositionCriteria implements EntityCriteriaInterface
{
    private ?array $positionIds;
    private ?string $statuses;

    /**
     * @param array|null $positionIds
     * @param string|null $statuses
     */
    public function __construct(
        ?array $positionIds = null,
        ?string $statuses = null
    ) {
        $this->positionIds = $positionIds;
        $this->statuses = $statuses;
    }


    public function getIds(): ?array
    {
        return $this->positionIds;
    }


    public function isEmpty(): bool
    {
        return empty($this->positionIds) && empty($this->statuses);
    }
}
