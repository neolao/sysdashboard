<?php
require dirname(__FILE__).'/../bootstrap.php';
$application = new Application(CONFIG_PATH.'/general.ini');
$application->viewType = Application::API_VIEW;
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

// PHP_AUTH_USER is not set if PHP running as CGI
if (!empty($_SERVER['HTTP_AUTHORIZATION'])) {
    $httpAuthorization = $_SERVER['HTTP_AUTHORIZATION'];
    $clearAuthorization = base64_decode(substr($httpAuthorization, 6));
    list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':', $clearAuthorization);
}

// If the login and password are not set, then it's over
if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
    authError();
}


// Get login and password from client
$login = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];


// If the user does not exist, then it's over
if (!array_key_exists($login, $application->users)) {
    authError();
}


// If passwords do not match, then it's over
$user = $application->users[$login];
$authenticated = $user->checkPassword($password);
if (!$authenticated) {
    authError();
}


// Get data informations: type, identifier and property
header('Content-Type: text/plain');
if (!isset($_SERVER['PATH_INFO'])) {
    die('Type undefined');
}
$pathInfo = $_SERVER['PATH_INFO'];
$pathInfo = explode('/', $pathInfo);
array_shift($pathInfo);

if (count($pathInfo) === 0) {
    die('Type undefined');
}
$type = array_shift($pathInfo);

if (count($pathInfo) === 0) {
    die('Identifier undefined');
}
$identifier = array_shift($pathInfo);

if (count($pathInfo) === 0) {
    die('Property undefined');
}
$property = array_shift($pathInfo);

$method = $_SERVER['REQUEST_METHOD'];


// Get data
switch ($type) {
    
    case 'module':
        if (!array_key_exists($identifier, $application->modules)) {
            die("Module $identifier not found");
        }
        $module = $application->modules[$identifier];
        if (!isset($module->$property) && !method_exists($module, "get_$property") && !method_exists($module, "set_$property")) {
            die("Property $property not found");
        }
        
        if ($method === 'GET') {
            $json = json_encode($module->$property);
            die($json);
        } else if ($method === 'PUT') {
            $data = file_get_contents('php://input');
            $data = json_decode($data);
            if ($data === null) {
                die("Data is not a JSON\n");
            }
            $module->$property = $data;
            die('OK');
        } else {
            die('Invalid HTTP method');
        }
        break;
}
die("Invalid type: $type");
