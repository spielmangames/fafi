<?php

declare(strict_types=1);

class BoardComposition
{
    /** @var int[] */
    private array $attack;

    /** @var int[] */
    private array $defence;


    /**
     * @param int[] $attack
     *
     * @return void
     */
    public function setAttack(array $attack): void
    {
        $this->attack = $attack;
    }

    /** @return int[] */
    public function getAttack(): array
    {
        return $this->attack;
    }

    public function getAttackDicesQty(): int
    {
        return count($this->getAttack());
    }

    /**
     * @param int[] $defence
     *
     * @return void
     */
    public function setDefence(array $defence): void
    {
        $this->defence = $defence;
    }

    /** @return int[] */
    public function getDefence(): array
    {
        return $this->defence;
    }

    public function getDefenceDicesQty(): int
    {
        return count($this->getDefence());
    }
}
