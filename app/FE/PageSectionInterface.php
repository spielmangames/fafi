<?php

namespace FAFI\FE;

interface PageSectionInterface
{
//    public function getY(): int;
    public function get(): array;
    public function getInside(): array;
    public function getYReserve(): int;
}
