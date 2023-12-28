<?php

declare(strict_types=1);

abstract class AbstractCoach implements CoachInterface
{
    public function rollDice(int $dimensionsQty = CoachInterface::COMPLECT_DICE_DIMENSIONS_QTY): int
    {
        return mt_rand(1, $dimensionsQty);
    }

    public function rollDices(int $dicesQty, int $dimensionsQty = CoachInterface::COMPLECT_DICE_DIMENSIONS_QTY): array
    {
        $dices = [];

        for ($i = 1; $i <= $dicesQty; $i++) {
            $dices[] = $this->rollDice($dimensionsQty);
        }

        return $dices;
    }

    public function rollCoin(): bool
    {
        return (bool)mt_rand(0, 1);
    }


    abstract protected function defineAttackPoints(int $attackPointsRemain): int;

    public function notifyOnLastAttack(): void
    {
        echo 'LAST ATTACK!!';
    }


    abstract protected function defineDefencePoints(BoardComposition $boardComposition, int $defencePointsRemain, bool $lastAttack = false): int;


    protected function defineIfReActPossible(int $moralePointsRemain): bool
    {
        if (!$moralePointsRemain) {
            return false;
        }

        return true;
    }


    protected function defineIfCompositionForGoal(BoardComposition $boardComposition): bool
    {
        return max($boardComposition->getAttack()) > max($boardComposition->getDefence());
    }

    protected function defineIfCompositionForFoul(BoardComposition $boardComposition): bool
    {
        return max($boardComposition->getAttack()) === max($boardComposition->getDefence());
    }

    protected function defineIfCompositionForNothing(BoardComposition $boardComposition): bool
    {
        return max($boardComposition->getAttack()) < max($boardComposition->getDefence());
    }

    protected function defineIfCompositionAttackBest(BoardComposition $boardComposition): bool
    {
        return min($boardComposition->getAttack()) === CoachInterface::COMPLECT_DICE_DIMENSIONS_QTY;
    }

    protected function defineIfCompositionAttackNice(BoardComposition $boardComposition): bool
    {
        return max($boardComposition->getAttack()) === CoachInterface::COMPLECT_DICE_DIMENSIONS_QTY;
    }

    protected function defineIfCompositionAttackWorst(BoardComposition $boardComposition): bool
    {
        return max($boardComposition->getAttack()) === 1;
    }

    protected function defineIfCompositionDefenceBest(BoardComposition $boardComposition): bool
    {
        return min($boardComposition->getDefence()) === CoachInterface::COMPLECT_DICE_DIMENSIONS_QTY;
    }

    protected function defineIfCompositionDefenceNice(BoardComposition $boardComposition): bool
    {
        return max($boardComposition->getDefence()) === CoachInterface::COMPLECT_DICE_DIMENSIONS_QTY;
    }

    protected function defineIfCompositionDefenceWorst(BoardComposition $boardComposition): bool
    {
        return max($boardComposition->getDefence()) === 1;
    }
}
