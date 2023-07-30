<?php

require_once 'app/boot/bootstrap.php';
require_once 'demo.php';

use FAFI\FAFI;
use FAFI\logs\Logger;


Logger::logStart(FAFI::SUBJECT);
$fafi = new FAFI();

$fafi->installAppWithSample();

//demoPlayerService($fafi);
//demoImport($fafi);
//demoFront($fafi);

Logger::logFinish(FAFI::SUBJECT);
