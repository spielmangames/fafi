<?php

require_once 'app/boot/bootstrap.php';
require_once 'demo.php';

use FAFI\FAFI;


echo EOL;
echo('FAFI 2022: started.');
echo EOL;


$fafi = new FAFI();

$fafi->installAppWithSample();

//demoPlayerService($fafi);
//demoImport($fafi);
//demoFront($fafi);


echo EOL;
echo('FAFI 2022: finished.');
echo EOL;

