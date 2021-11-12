<?php

namespace FAFI\FE\Structure;

interface ContentableInterface
{
    public function getX(): int;
    public function getY(): int;

    public function getContent(): array;
}
