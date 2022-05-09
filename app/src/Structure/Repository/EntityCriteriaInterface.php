<?php

namespace FAFI\src\Structure\Repository;

interface EntityCriteriaInterface
{
    /** @return int[]|null */
    public function getIds(): ?array;

    public function isEmpty(): bool;
}
