<?php

declare(strict_types=1);

namespace FAFI\src\FE\Structure\PageSection;

use FAFI\src\FE\Structure\ContentableInterface;

interface PageSectionInterface extends ContentableInterface
{
    public function getYReserve(): int;

    public function getInside(): array;
}
