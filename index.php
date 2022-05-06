<?php

require_once 'app/boot/bootstrap.php';
require_once 'demo.php';

use FAFI\entity\FAFI;


echo EOL;
echo('FAFI 2022: started.');
echo EOL;


$fafi = new FAFI();

demoImport($fafi);
//demoInstall($fafi);
//demoPlayerService($fafi);
//demoFront($fafi);


echo EOL;
echo('FAFI 2022: finished.');
echo EOL;

