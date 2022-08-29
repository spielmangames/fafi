<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto;

interface EntityInterface
{
    public function getId(): ?int;
    public function __toString(): string;
}
