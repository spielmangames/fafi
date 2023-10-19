<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\FileSchemas\Entity\Mapper;

interface ImExableEntityMapperInterface
{
    public function getMap(): array;

    public function fromFile(string $field): string;
    public function toFile(string $field): string;
}
