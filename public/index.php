<?php
require dirname(__FILE__).'/../bootstrap.php';
$application = Application::getInstance();
$application->initialize(CONFIG_PATH.'/general.ini');
$application->addModules(CONFIG_PATH.'/modules.ini');
$application->addTabs(CONFIG_PATH.'/tabs.xml');
$application->view->render();

