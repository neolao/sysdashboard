<?php
// Constants
define('BASE_PATH',     dirname(__FILE__));
define('LIB_PATH',      BASE_PATH.'/lib');
define('CLASSES_PATH',  BASE_PATH.'/classes');
define('CONFIG_PATH',   BASE_PATH.'/config');
define('MODULES_PATH',  BASE_PATH.'/modules');
define('DATA_PATH',     BASE_PATH.'/data');
define('PUBLIC_PATH',   BASE_PATH.'/public');

// Autoload classes
function __autoload($className)
{
    $filePath = CLASSES_PATH.'/'.str_replace('_', '/', $className).'.php';
    if (file_exists($filePath)) {
        include_once $filePath;
    }
}

$application = Application::getInstance();
$application->initialize(CONFIG_PATH.'/general.json');
$application->addModules(CONFIG_PATH.'/modules.json');

