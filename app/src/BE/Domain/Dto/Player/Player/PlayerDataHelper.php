<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Player\Player;

trait PlayerDataHelper
{
    public function buildPlayerFullName(): string
    {
        $fullName = [];

        $name = $this->getName();
        if ($name) {
            $fullName[] = $name;
        }
        $particle = $this->getParticle();
        if ($particle) {
            $fullName[] = $particle;
        }
        $fullName[] = $this->getSurname();

        return implode(' ', $fullName);
    }
}
