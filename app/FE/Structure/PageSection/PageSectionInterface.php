<?php

namespace FAFI\FE\Structure\PageSection;

use FAFI\FE\Structure\ContentableInterface;

interface PageSectionInterface extends ContentableInterface
{
    public function getYReserve(): int;

    public function getInside(): array;
}
