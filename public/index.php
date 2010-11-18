<?php
require dirname(__FILE__).'/../bootstrap.php';
$application = Application::getInstance();

?><!DOCTYPE html>
<html>
    <head>
    <title><?php echo $application->title; ?></title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
    <body>
        <h1><?php echo $application->title; ?></h1>
    </body>
</html>

