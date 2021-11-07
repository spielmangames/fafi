<?php


// preset system settings
set_time_limit(0);
ini_set('display_errors', true);


// define constants
define('DS', DIRECTORY_SEPARATOR);
define('EOL', PHP_EOL);

define('PATH_APP', dirname(realpath((__DIR__))) . DS);
//define('PATH_QA', dirname(PATH_APP) . DS . 'qa' . DS);
define('PATH_VENDOR', dirname(PATH_APP) . DS . 'vendor' . DS);


// register vendor classes
require_once(PATH_VENDOR . 'autoload.php');
