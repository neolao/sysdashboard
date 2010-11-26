<?php
require dirname(__FILE__).'/../bootstrap.php';
$application = new Application();
$application->initialize(CONFIG_PATH.'/general.ini');
$application->addModules(CONFIG_PATH.'/modules.ini');


