<?php

namespace FAFI\src\BE\Structure;

interface EntityInterface
{
    public function getId(): ?int;
    public function __toString(): string;
}
