<?php

declare(strict_types=1);

class FafibotCoach extends AbstractCoach implements CoachInterface
{
    public function attack(PointsRemain $pointsRemain): array
    {
        $dicesQty = $this->defineAttackPoints($pointsRemain->getAttack());
        if ($dicesQty === $pointsRemain->getAttack()) {
            $this->notifyOnLastAttack();
        }

        return $this->rollDices($dicesQty);

    }

    public function defineAttackPoints(int $attackPointsRemain): int
    {
        $desire = $this->rollDice(CoachInterface::COMPLECT_DICES_QTY);

        return ($desire > $attackPointsRemain) ? $attackPointsRemain : $desire;
    }


    public function reActWhileAttacking(int $moralePointsRemain, BoardComposition $boardComposition, bool $lastAttack = false): array
    {
        $result = [];

        if(!$this->defineIfReActPossible($moralePointsRemain)) {
            return $result;
        }

        if ($this->defineIfCompositionForGoal($boardComposition)) {
            return $result;
        }
        if(!$this->defineIfReActWhileAttackingDesired()) {
            return $result;
        }

        $actWithOwn = $this->defineIfReActWithAttack();
        if ($actWithOwn) {
//            if ($this->defineIfCompositionAttackBest($boardComposition)) {
//                return $result;
//            }
            if ($this->defineIfCompositionAttackNice($boardComposition)) {
                return $result;
            }

            $neededDices = $this->defineIfCompositionForFoul($boardComposition)
                ? $this->defineDicesAttackEqual($boardComposition)
                : $this->defineDicesAttackBetter($boardComposition);
            $neededDicesQty = count($neededDices);
            if ($neededDicesQty > $boardComposition->getAttackDicesQty()) {
                return $result;
            }

            $moralePointsNeeded = $this->defineMoralePointsToActOpponentDices($neededDicesQty);
            if ($moralePointsRemain < $moralePointsNeeded) {
                return $result;
            }

            $result = $this->reAttackOwn();
        } else {
            if ($this->defineIfCompositionDefenceWorst($boardComposition)) {
                return $result;
            }

            $neededDices = $this->defineIfCompositionForFoul($boardComposition)
                ? $this->defineDicesDefenceEqual($boardComposition)
                : $this->defineDicesDefenceBetter($boardComposition);
            $neededDicesQty = count($neededDices);
            if ($neededDicesQty > $boardComposition->getAttackDicesQty()) {
                return $result;
            }

            $moralePointsNeeded = $this->defineMoralePointsToActOpponentDices($neededDicesQty);
            if ($moralePointsRemain < $moralePointsNeeded) {
                return $result;
            }
//            if ($neededDicesQty > $moralePointsNeeded) {
//                return $result;
//            }

            $result = $this->reDefenceOpponent();
        }

        return $result;
    }

    private function defineIfReActWhileAttackingDesired(): bool
    {
        return $this->rollCoin();
    }

    private function defineIfReActWithAttack(): bool
    {
        return $this->rollCoin();
    }

    private function defineDicesDefenceBetter(BoardComposition $boardComposition): array
    {
        $attackMax = max($boardComposition->getAttack());
        $defenceBetter = array_filter($boardComposition->getDefence(), fn($defPoint) => $defPoint > $attackMax);

        return $defenceBetter;
    }

    private function defineDicesDefenceEqual(BoardComposition $boardComposition): array
    {
        $attackMax = max($boardComposition->getAttack());
        $defenceBetter = array_filter($boardComposition->getDefence(), fn($defPoint) => $defPoint === $attackMax);

        return $defenceBetter;
    }

    private function reDefenceOpponent(): array
    {
        // TBD
    }

    private function reAttackOwn(): array
    {
        // TBD
    }
    public function defence(BoardComposition $boardComposition, int $defencePointsRemain): array
    {
        $dicesQty = $this->defineDefencePoints($boardComposition, $defencePointsRemain);
        $dicesQty =+ CoachInterface::MATCH_DEFENCE_RESERVE;
//        $dicesQty += CoachInterface::DEFENCE_RESERVE;

        return $this->rollDices($dicesQty);
    }

    protected function defineDefencePoints(BoardComposition $boardComposition, int $defencePointsRemain, bool $lastAttack = false): int
    {
        $desire = $lastAttack ? CoachInterface::COMPLECT_DICES_QTY : $this->rollDice(CoachInterface::COMPLECT_DICES_QTY);
        $desire =- CoachInterface::MATCH_DEFENCE_RESERVE;
//        $desire -= CoachInterface::MATCH_DEFENCE_RESERVE;

        return ($desire > $defencePointsRemain) ? $defencePointsRemain : $desire;
    }


    public function reActWhileDefending(int $moralePointsRemain, BoardComposition $boardComposition, bool $lastAttack = false): array
    {
        $result = [];

        if(!$this->defineIfReActPossible($moralePointsRemain)) {
            return $result;
        }

        if ($this->defineIfCompositionForNothing($boardComposition)) {
            return $result;
        }
        if(!$this->defineIfReActWhileDefendingDesired($boardComposition)) {
            return $result;
        }

        $actWithOwn = !$this->defineIfReActWithAttack();
        if ($actWithOwn) {
//            if ($this->defineIfCompositionDefenceBest($boardComposition)) {
//                return $result;
//            }
            if ($this->defineIfCompositionDefenceNice($boardComposition)) {
                return $result;
            }

            // ... re-defence own
        } else {
//            if ($this->defineIfCompositionAttackBest($boardComposition)) {
//                return $result;
//            }

            $neededDices = $this->defineDicesAttackBetter($boardComposition);
            $neededDicesQty = count($neededDices);
            if ($neededDicesQty > $boardComposition->getDefenceDicesQty()) {
                return $result;
            }

            $moralePointsNeeded = $this->defineMoralePointsToActOpponentDices($neededDicesQty);
            if ($neededDicesQty > $moralePointsNeeded || $moralePointsRemain < $moralePointsNeeded) {
                return $result;
            }

            $result = $this->reAttackOpponent();
        }

        return $result;
    }

    private function defineIfReActWhileDefendingDesired(BoardComposition $boardComposition): bool
    {
        return $this->rollCoin();
    }

    private function defineDicesAttackBetter(BoardComposition $boardComposition): array
    {
        $defenceMax = max($boardComposition->getDefence());
        $attackBetter = array_filter($boardComposition->getAttack(), fn($attPoint) => $attPoint > $defenceMax);

        return $attackBetter;
    }

    private function defineDicesAttackEqual(BoardComposition $boardComposition): array
    {
        $defenceMax = max($boardComposition->getDefence());
        $attackBetter = array_filter($boardComposition->getAttack(), fn($attPoint) => $attPoint === $defenceMax);

        return $attackBetter;
    }

    private function reAttackOpponent(): array
    {
        // TBD
    }


    private function defineMoralePointsToActOwnDices(int $dicesQty): int
    {
        switch ($dicesQty) {
            case 1:
                return 1;
            case 3:
                return 2;
        }

        return 9876543210;
    }

    private function defineMoralePointsToActOpponentDices(int $dicesQty): int
    {
        switch ($dicesQty) {
            case 1:
                return 2;
            case 2:
                return 3;
        }
        return 9876543210;
    }
}
