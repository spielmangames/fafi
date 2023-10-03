<?php

declare(strict_types=1);

namespace name_generator;

interface HumanNameGeneratorInterface
{
    public function generateName(): string;
    public function generateSurname(): string;
}
