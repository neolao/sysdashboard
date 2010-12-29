<?php
// Check PHP version
if (version_compare(PHP_VERSION, '5.2.0') < 0) {
    die('You need PHP version 5.2.0 or above. Your version is '.PHP_VERSION.'.');
}

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
    $includePaths = explode(PATH_SEPARATOR, get_include_path());
    $relativeFilePath = str_replace('_', '/', $className).'.php';
    foreach ($includePaths as $includePath) {
        $filePath = $includePath.'/'.$relativeFilePath;
        if (file_exists($filePath)) {
            include_once $filePath;
        }
    }
}
set_include_path(get_include_path().PATH_SEPARATOR.CLASSES_PATH);
set_include_path(get_include_path().PATH_SEPARATOR.LIB_PATH);


