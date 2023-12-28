<?php

declare(strict_types=1);

class PointsRemain
{
    private int $attack;
    private int $defence;
    private int $morale;

    public function setAttack(int $attack): void
    {
        $this->attack = $attack;
    }

    public function getAttack(): int
    {
        return $this->attack;
    }

    public function setDefence(int $defence): void
    {
        $this->defence = $defence;
    }

    public function getDefence(): int
    {
        return $this->defence;
    }

    public function setMorale(int $morale): void
    {
        $this->morale = $morale;
    }

    public function getMorale(): int
    {
        return $this->morale;
    }
}
