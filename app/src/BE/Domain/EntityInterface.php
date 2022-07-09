<?php

namespace FAFI\src\BE\Domain;

interface EntityInterface
{
    public function getId(): ?int;
    public function __toString(): string;
}
