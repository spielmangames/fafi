<?php

declare(strict_types=1);

namespace name_generator;

class HumanNameGenerator implements HumanNameGeneratorInterface
{
    private StringGenerator $stringGenerator;

    public function __construct()
    {
        $this->stringGenerator = new StringGenerator();
    }

    public function generateName(): string
    {
        return $this->stringGenerator->generateRandomString(2, 8, 3);
    }

    public function generateSurname(): string
    {
        return $this->stringGenerator->generateRandomString(4, 12, 3);
    }
}
