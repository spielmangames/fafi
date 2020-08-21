<?php

class schedulerTester
{
    // Q errors
    public const ERR_INVALID_GAMES_IN_POOL_QTY = 'Qty of Games in a pool is %d instead of %d';
    public const ERR_INVALID_MATCHDAYS_IN_POOL_QTY = 'Qty of Matchdays in a pool is %d instead of %d';
    public const ERR_INVALID_LAPS_IN_POOL_QTY = 'Qty of Laps in a pool is %d instead of %d';

    // C errors
    public const ERR_INVALID_MATCHDAYS_IN_LAP_QTY = 'Lap #%d has %d Matchdays instead of %d';
    public const ERR_INVALID_GAMES_IN_MATCHDAY_QTY = 'Matchday #%d has %d Games instead of %d';
    public const ERR_INVALID_TEAMS_IN_GAME_QTY = 'Game #%d has %d Teams instead of %d';
    public const ERR_GAMES_HOME_IN_ROW_OVERLIMIT = 'Team %s plays too many Games at home (at least in Matchdays %s of Lap #%d), while the limit is %d';
    public const ERR_GAMES_AWAY_IN_ROW_OVERLIMIT = 'Team %s plays too many Games away (at least in Matchdays %s of Lap #%d), while the limit is %d';
    public const ERR_TEAM_MISSES_MATCHDAY = 'Not every Team plays in Matchday #%d';

    private $failedValidations = [];

    /** @var scheduler */
    private $scheduler;


    public function __construct(scheduler $scheduler)
    {
        $this->scheduler = $scheduler;
    }


    /**
     * T=2:  G=2    M=2      L=2
     * T=4:  G=12   M=24     L=3072(v=2), L=0(v=1)
     * T=6:  G=30   M=720    L=?
     * T=8:  G=56   M=40320  L=?
     *
     * @return bool
     */
    public function testPoolQ(): bool
    {
        $teamsQty = $this->scheduler->teamsQty;

        # G = (T*T) - T
        $exp = pow($teamsQty, 2) - $teamsQty;
        $act = count($this->scheduler->getGamesPool());
        if ($exp !== $act) {
            $this->failedValidations[] = sprintf(self::ERR_INVALID_GAMES_IN_POOL_QTY, $act, $exp);
            return false;
        }

        # M = T!
        $exp = 1;
        for ($f = 1; $f <= $teamsQty; $f++) {
            $exp = $exp * $f;
        }
        $act = count($this->scheduler->getMatchdaysPool());
        if ($exp !== $act) {
            $this->failedValidations[] = sprintf(self::ERR_INVALID_MATCHDAYS_IN_POOL_QTY, $act, $exp);
            return false;
        }

        # L = ?
        $exp = 0;
        switch ($teamsQty) {
            case 2:
                $exp = 2;
                break;
            case 4:
                $exp = 3072;
                break;
            case 6:
//            $exp = ;
                break;
            case 8:
//            $exp = ;
                break;
        }
        $act = count($this->scheduler->getLapsPool());
        if ($exp !== $act) {
            $this->failedValidations[] = sprintf(self::ERR_INVALID_LAPS_IN_POOL_QTY, $act, $exp);
            return false;
        }

        return true;
    }

    public function testPoolC(): bool
    {
        $limit = $this->scheduler->variance;
        $teamsQty = $this->scheduler->teamsQty;

        foreach ($this->scheduler->getLapsPool() as $l => $lap) {
            if (count($lap) !== $teamsQty - 1) {
                $act = count($lap);
                $exp = $teamsQty - 1;
                $this->failedValidations[] = sprintf(self::ERR_INVALID_MATCHDAYS_IN_LAP_QTY, $l, $act, $exp);
                return false;
            }

            foreach ($lap as $m => $matchday) {
                if (count($matchday) !== $teamsQty / scheduler::TEAMS_PER_GAME_QTY) {
                    $act = count($matchday);
                    $exp = $teamsQty / scheduler::TEAMS_PER_GAME_QTY;
                    $this->failedValidations[] = sprintf(self::ERR_INVALID_GAMES_IN_MATCHDAY_QTY, $m, $act, $exp);
                    return false;
                }

                $mts = $this->scheduler->getTeamsPool();
                foreach ($matchday as $g => $game) {
                    if (strlen($game) !== scheduler::TEAMS_PER_GAME_QTY) {
                        $act = strlen($game);
                        $exp = scheduler::TEAMS_PER_GAME_QTY;
                        $this->failedValidations[] = sprintf(self::ERR_INVALID_TEAMS_IN_GAME_QTY, $g, $act, $exp);
                        return false;
                    }

                    $home = $game[0];
                    $away = $game[1];
                    unset($mts[array_search($home, $mts)]);
                    unset($mts[array_search($away, $mts)]);

                    $homeUnbalanced = 1;
                    $awayUnbalanced = 1;

                    $mPrev1 = $m - 1;
                    $mPrev2 = $m - 2;
                    if ($mPrev1 >= 0) {
                        $homePrev1 = $lap[$mPrev1][$g][0];
                        $awayPrev1 = $lap[$mPrev1][$g][1];

                        if ($home === $homePrev1) {
                            $homeUnbalanced++;
                        }
                        if ($away === $awayPrev1) {
                            $awayUnbalanced++;
                        }

                        if ($mPrev2 >= 0 && $limit > 1) {
                            $homePrev2 = $lap[$mPrev2][$g][0];
                            $awayPrev2 = $lap[$mPrev2][$g][1];

                            if ($home === $homePrev2) {
                                $homeUnbalanced++;
                            }
                            if ($away === $awayPrev2) {
                                $awayUnbalanced++;
                            }
                        }
                    }

                    if ($homeUnbalanced > $limit) {
                        $mm = implode(', ', ['#' . $mPrev2, '#' . $mPrev1, '#' . $m]);
                        $this->failedValidations[] = sprintf(self::ERR_GAMES_HOME_IN_ROW_OVERLIMIT, $home, $mm, $l, $limit);
                        return false;
                    }
                    if ($awayUnbalanced > $limit) {
                        $mm = implode(' & ', ['#' . $mPrev2, '#' . $mPrev1, '#' . $m]);
                        $this->failedValidations[] = sprintf(self::ERR_GAMES_AWAY_IN_ROW_OVERLIMIT, $away, $mm, $l, $limit);
                        return false;
                    }
                }
                if (!empty($mts)) {
                    $this->failedValidations[] = sprintf(self::ERR_TEAM_MISSES_MATCHDAY, $m);
                    return false;
                }
            }
        }

        return true;
    }


    public function getFailedValidations(): array
    {
        return $this->failedValidations;
    }
}
