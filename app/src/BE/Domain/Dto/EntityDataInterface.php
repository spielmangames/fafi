<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto;

interface EntityDataInterface
{
    public function setId(int $id): self;
//    public function getId(): ?int;
}
