<?php
require dirname(__FILE__).'/../bootstrap.php';
$application = new Application(CONFIG_PATH.'/general.ini');
$application->addUsers(CONFIG_PATH.'/users.ini');
$application->addModules(CONFIG_PATH.'/modules.ini');


/**
 * Authentication error
 */
function authError()
{
    header('WWW-Authenticate: Basic');
    header('HTTP/1.0 401 Unauthorized');
    header('Content-Type: text/plain');
    echo 'Error 401 Unauthorized';
    exit;
}

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
    authError();
}

$login = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];

if (!array_key_exists($login, $application->users)) {
    authError();
}

$user = $application->users[$login];
$authenticated = $user->checkPassword($password);
if (!$authenticated) {
    authError();
}

header('Content-Type: text/plain');
$pathInfo = $_SERVER['PATH_INFO'];
die('ok '.$pathInfo);
