<?php

declare(strict_types=1);

interface CoachInterface
{
    public const COMPLECT_DICES_QTY = 5;
    public const COMPLECT_DICE_DIMENSIONS_QTY = 6;

    public const MATCH_DEFENCE_RESERVE = 1;


    public function rollDice(int $dimensionsQty = CoachInterface::COMPLECT_DICE_DIMENSIONS_QTY): int;

    /**
     * @param int $dicesQty
     * @param int $dimensionsQty
     *
     * @return int[]
     */
    public function rollDices(int $dicesQty, int $dimensionsQty = CoachInterface::COMPLECT_DICE_DIMENSIONS_QTY): array;

    public function rollCoin(): bool;


    /**
     * @param PointsRemain $pointsRemain
     *
     * @return int[]
     */
    public function attack(PointsRemain $pointsRemain): array;

    public function notifyOnLastAttack(): void;

    public function reActWhileAttacking(int $moralePointsRemain, BoardComposition $boardComposition, bool $lastAttack = false): array;


    /**
     * @param BoardComposition $boardComposition
     * @param int $defencePointsRemain
     *
     * @return int[]
     */
    public function defence(BoardComposition $boardComposition, int $defencePointsRemain): array;

    /**
     * @param int $moralePointsRemain
     * @param BoardComposition $boardComposition
     * @param bool $lastAttack
     *
     * @return int[]
     */
    public function reActWhileDefending(int $moralePointsRemain, BoardComposition $boardComposition, bool $lastAttack = false): array;
}
