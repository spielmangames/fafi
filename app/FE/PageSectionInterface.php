<?php

namespace FAFI\FE;

interface PageSectionInterface extends ContentableInterface
{
//    public function getY(): int;
    public function get(): array;
    public function getInside(): array;
    public function getYReserve(): int;
}
