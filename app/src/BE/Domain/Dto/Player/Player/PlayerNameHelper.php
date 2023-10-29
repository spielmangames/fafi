<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Player\Player;

use FAFI\src\BE\Domain\Persistence\Player\Player\PlayerResource;

trait PlayerNameHelper
{
    public function constructFullName(bool $initials = false): string
    {
        $result = [];

        $name = $this->getName();
        if ($name) {
            if ($initials) {
                $name = $name[0] . '.';
            }
            $result[] = $name;
        }
        $result[] = $this->constructSurnameWithParticle();

        $delimiter = $initials ? '' : ' ';
        return implode($delimiter, $result);
    }

    public function constructSurnameWithParticle(): string
    {
        $result = [];

        $particle = $this->getParticle();
        if ($particle) {
            $result[] = $particle;
        }
        $result[] = $this->getSurname();

        return implode(' ', $result);
    }


    public function deconstructFullName(string $fullName): array
    {
        $fullName = explode(' ', $fullName);

        $result[PlayerResource::SURNAME_FIELD] = array_pop($fullName);
        if (!empty($fullName)) {
            $result[PlayerResource::NAME_FIELD] = array_shift($fullName);
        }
        if (!empty($fullName)) {
            $result[PlayerResource::PARTICLE_FIELD] = implode(' ', $fullName);
        }

        return $result;
    }
}
