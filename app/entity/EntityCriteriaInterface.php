<?php

namespace FAFI\entity;

interface EntityCriteriaInterface
{
    public function getIds(): ?array;

    public function isEmpty(): bool;
}
