<?php

require_once 'app/boot/bootstrap.php';
require_once 'demo.php';

use FAFI\FAFI;


$fafi = new FAFI();

$fafi->installAppWithSample();

//demoPlayerService($fafi);
//demoImport($fafi);
//demoFront($fafi);
