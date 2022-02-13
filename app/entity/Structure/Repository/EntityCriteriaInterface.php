<?php

namespace FAFI\entity\Structure\Repository;

interface EntityCriteriaInterface
{
    /** @return int[]|null */
    public function getIds(): ?array;

    public function isEmpty(): bool;
}
