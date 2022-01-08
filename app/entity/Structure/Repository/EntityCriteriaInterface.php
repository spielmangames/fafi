<?php

namespace FAFI\entity\Structure\Repository;

interface EntityCriteriaInterface
{
    public function getIds(): ?array;

    public function isEmpty(): bool;
}
