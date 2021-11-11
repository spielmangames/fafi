<?php

namespace FAFI\FE\Structure\PageSection;

use FAFI\FE\Structure\ContentableInterface;

interface PageSectionInterface extends ContentableInterface
{
//    public function getY(): int;
    public function get(): array;
    public function getInside(): array;
    public function getYReserve(): int;
}
