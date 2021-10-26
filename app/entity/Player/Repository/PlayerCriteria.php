<?php

namespace FAFI\entity\Player\Repository;

class PlayerCriteria
{
    private ?array $playerIds;
    private ?string $entity;
    private ?array $statuses;

    /**
     * @param array|null $playerIds
     */
    public function __construct(
        ?array $playerIds = null
    ) {
        $this->playerIds = $playerIds;
    }

    public function getPlayerIds(): ?array
    {
        return $this->playerIds;
    }


    public function isEmpty(): bool
    {
        return empty($this->entity) && empty($this->importIds) && empty($this->statuses);
    }
}
