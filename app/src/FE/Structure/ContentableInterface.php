<?php

declare(strict_types=1);

namespace FAFI\src\FE\Structure;

interface ContentableInterface
{
    public function getX(): int;
    public function getY(): int;

    public function getContent(): array;
}
