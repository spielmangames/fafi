<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Player\Player;

trait PlayerDataHelper
{
    public function buildFullName(bool $initials = false): string
    {
        $result = [];

        $name = $this->getName();
        if ($name) {
            if ($initials) {
                $name = $name[0] . '.';
            }
            $result[] = $name;
        }
        $result[] = $this->buildSurnameWithParticle();

        $delimiter = $initials ? '' : ' ';
        return implode($delimiter, $result);
    }

    public function buildSurnameWithParticle(): string
    {
        $result = [];

        $particle = $this->getParticle();
        if ($particle) {
            $result[] = $particle;
        }
        $result[] = $this->getSurname();

        return implode(' ', $result);
    }
}
