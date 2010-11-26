<?php
require dirname(__FILE__).'/../bootstrap.php';
$application = Application::getInstance();
$application->initialize(CONFIG_PATH.'/general.json');
$application->addModules(CONFIG_PATH.'/modules.json');


