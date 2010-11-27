<?php
require dirname(__FILE__).'/../bootstrap.php';
$application = new Application(CONFIG_PATH.'/general.ini');
$application->addModules(CONFIG_PATH.'/modules.ini');
$application->addTabs(CONFIG_PATH.'/tabs.xml');
$application->view->render();

