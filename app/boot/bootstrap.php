<?php


presetSystemSettings();
defineConstants();
registerVendor();


function presetSystemSettings(): void
{
    set_time_limit(0);
    ini_set('display_errors', true);
}

function defineConstants(): void
{
    define('DS', DIRECTORY_SEPARATOR);
    define('EOL', PHP_EOL);

    define('PATH_APP', dirname(realpath((__DIR__))) . DS);
    define('PATH_STORAGE', PATH_APP . 'data' . DS);
    define('PATH_QA', dirname(PATH_APP) . DS . 'tests' . DS);
    define('PATH_VENDOR', dirname(PATH_APP) . DS . 'vendor' . DS);
}

function registerVendor(): void
{
    require_once(PATH_VENDOR . 'autoload.php');
}
