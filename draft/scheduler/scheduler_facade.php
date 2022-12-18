<?php

require_once 'scheduler.php';
require_once 'schedulerTester.php';


$scheduler = new scheduler(4, 2);
$teamsPool = $scheduler->getTeamsPool();
$gamesPool = $scheduler->getGamesPool();
$matchdaysPool = $scheduler->getMatchdaysPool();
$lapsPool = $scheduler->getLapsPool();


$tester = new schedulerTester($scheduler);
$testQ = $tester->testPoolQ();
$testC = $tester->testPoolC();
$err = $tester->getFailedValidations();
var_dump($err);
