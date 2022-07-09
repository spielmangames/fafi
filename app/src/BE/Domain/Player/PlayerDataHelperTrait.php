<?php

namespace FAFI\src\BE\Domain\Player;

trait PlayerDataHelperTrait
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
