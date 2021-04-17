<?php

class scheduler
{
    // modes
    public const D_GAME = 'game';
    public const D_MATCHDAY = 'matchday';
    public const D_LAP = 'lap';
    private $_mode;

    // settings
    public const TEAMS_PER_GAME_QTY = 2;
    public $teamsQty;
    public $variance;

    // pools
    protected $teamsPool;
    protected $gamesPool;
    protected $matchdaysPool;
    protected $lapsPool;


    public function __construct(int $teamsQty, int $variance)
    {
        $this->teamsQty = $teamsQty;
        $this->variance = $variance;
    }


    protected function setTeamsPool(): void
    {
        switch ($this->teamsQty) {
            case 2:
                $this->teamsPool = ['A', 'B'];
                break;
            case 4:
                $this->teamsPool = ['A', 'B', 'C', 'D'];
                break;
            case 6:
                $this->teamsPool = ['A', 'B', 'C', 'D', 'E', 'F'];
                break;
            case 8:
                $this->teamsPool = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
                break;
        }
    }

    protected function setGamesPool(): void
    {
        $this->_mode = self::D_GAME;
        $this->gamesPool = $this->getCombinations($this->getTeamsPool(), self::TEAMS_PER_GAME_QTY);
    }

    protected function setMatchdaysPool(): void
    {
        $this->_mode = self::D_MATCHDAY;
        $this->matchdaysPool = $this->getCombinations($this->getGamesPool(), $this->teamsQty / self::TEAMS_PER_GAME_QTY);
    }

    protected function setLapsPool(): void
    {
        $this->_mode = self::D_LAP;
        $lapsPool = $this->getCombinations($this->getMatchdaysPool(), $this->teamsQty - 1);
        $this->lapsPool = $this->reformLaps($lapsPool, $this->teamsQty);
    }


    private function getCombinations(array $objects, int $size, array $combinations = []): array
    {
        if (empty($combinations)) {
            $combinations = $objects;
        }
        if ($size === 1) {
            return $combinations;
        }

        $newCombinations = [];
        foreach ($combinations as $combination) {
            foreach ($objects as $object) {
                if ($combination === $object) {
                    continue;
                }

                if (!$this->isCompatible($combination, $object)) {
                    continue;
                }

                $newCombinations[] = $combination . $object;
            }
        }

        return $this->getCombinations($objects, $size - 1, $newCombinations);
    }

    private function isCompatible(string $context, string $object): bool
    {
        if ($this->_mode !== self::D_LAP) {
            $contexts = str_split($context, 2);
            $objects = str_split($object);
        } else {
            $contexts = str_split($context, $this->teamsQty);
            $objects = str_split($object, 2);
            $objects = $this->fillWithInverted($objects);
        }

        foreach ($contexts as $i => $c) {
            if ($this->_mode !== self::D_LAP) {
                $c = str_split($c);
            } else {
                $c = str_split($c, 2);
            }

            if (array_intersect($objects, $c)) {
                return false;
            }
        }

        if ($this->_mode === self::D_LAP) {
            $prevMatchday1 = count($contexts) - 1;
            $prevMatchday2 = count($contexts) - 2;

            if ($prevMatchday1 >= 0) {
                $prevMatchdays[] = str_split($contexts[$prevMatchday1], 2);
                if ($prevMatchday2 >= 0) {
                    $prevMatchdays[] = str_split($contexts[$prevMatchday2], 2);
                }

                if (!$this->isHomeAwayBalanced($prevMatchdays, str_split($object, 2))) {
                    return false;
                }
            }
        }

        return true;
    }

    private function fillWithInverted(array $objects): array
    {
        $inverted = $objects;
        foreach ($objects as $object) {
            $inverted[] = strrev($object);
        }

        return $inverted;
    }

    private function isHomeAwayBalanced(array $prevMatchdays, array $nextMatchday): bool
    {
        foreach ($nextMatchday as $nextGame) {
            $nextHome = str_split($nextGame)[0];
            $nextAway = str_split($nextGame)[1];


            foreach ($prevMatchdays as $prevMatchday) {
                $homeUnbalanced = 1;
                $awayUnbalanced = 1;
                foreach ($prevMatchday as $prevGame) {
                    $prevHome = str_split($prevGame)[0];
                    $prevAway = str_split($prevGame)[1];

                    if ($nextHome === $prevHome) {
                        $homeUnbalanced++;
                        if ($homeUnbalanced > $this->variance) {
                            return false;
                        }
                    }
                    if ($nextAway === $prevAway) {
                        $awayUnbalanced++;
                        if ($awayUnbalanced > $this->variance) {
                            return false;
                        }
                    }
                }
            }
        }

        return true;
    }

    private function reformLaps(array $laps, int $teamsQty): array
    {
        $lapsPool = [];
        foreach ($laps as $l => $lap) {
            $lap = str_split($lap, $teamsQty);
            foreach ($lap as $g => $games) {
                $games = str_split($games, self::TEAMS_PER_GAME_QTY);
                $lapsPool[$l][$g] = $games;
            }
        }

        return $lapsPool;
    }


    public function getTeamsPool(): array
    {
        if (empty($this->teamsPool)) {
            $this->setTeamsPool();
        }
        return $this->teamsPool;
    }

    public function getGamesPool(): array
    {
        if (empty($this->gamesPool)) {
            $this->setGamesPool();
        }
        return $this->gamesPool;
    }

    public function getMatchdaysPool(): array
    {
        if (empty($this->matchdaysPool)) {
            $this->setMatchdaysPool();
        }
        return $this->matchdaysPool;
    }

    public function getLapsPool(): array
    {
        if (empty($this->lapsPool)) {
            $this->setLapsPool();
        }
        return $this->lapsPool;
    }
}
