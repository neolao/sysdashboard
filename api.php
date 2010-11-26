<?php
require dirname(__FILE__).'/bootstrap.php';
$application = Application::getInstance();
$application->initialize(CONFIG_PATH.'/general.ini');
$application->addModules(CONFIG_PATH.'/modules.ini');

// Get parameters
$arguments = $_SERVER['argv'];
array_shift($arguments);

// We need an action
if (empty($arguments)) {
    die("Action is undefined\n");
}
$action = array_shift($arguments);

switch ($action) {
    // Get module data
    case 'getModuleData':
        if (empty($arguments)) {
            die("Module name is required\n");
        }
        $moduleName = array_shift($arguments);

        $module = $application->modules[$moduleName];
        if ($module instanceof Core_Module === false) {
            die("\"$moduleName\" is not a module\n");
        }

        $data = $module->getData();
        echo json_encode($data);
        break;

    // Set module data
    case 'setModuleData':
        if (empty($arguments)) {
            die("Module name is required\n");
        }
        $moduleName = array_shift($arguments);

        $module = $application->modules[$moduleName];
        if ($module instanceof Core_Module === false) {
            die("\"$moduleName\" is not a module\n");
        }

        if (empty($arguments)) {
            die("Data is required\n");
        }
        $data = array_shift($arguments);
        $data = json_decode($data);
        if ($data === null) {
            die("Data is not a JSON\n");
        }
        $module->setData($data);
        break;

    // Unknown action
    default:
        die("Invalid action \"$action\"\n");
}
