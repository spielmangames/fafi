<?php

namespace FAFI\entity\Player\Repository;

class PlayerCriteria
{
    private ?array $playerIds;
    private ?string $entity;
    private ?array $statuses;

    /**
     * @param array|null $playerIds
     * @param string|null $entity
     * @param array|null $statuses
     */
    public function __construct(
        ?array $playerIds = null,
        ?string $entity = null,
        ?array $statuses = null
    ) {
        $this->playerIds = $playerIds;
        $this->entity = $entity;
        $this->statuses = $statuses;
    }

    public function getPlayerIds(): ?array
    {
        return $this->playerIds;
    }

    public function getEntity(): ?string
    {
        return $this->entity;
    }

    public function getStatuses(): ?array
    {
        return $this->statuses;
    }


    public function isEmpty(): bool
    {
        return empty($this->entity) && empty($this->importIds) && empty($this->statuses);
    }
}
