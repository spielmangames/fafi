<?php

namespace FAFI\entity\Player;

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
