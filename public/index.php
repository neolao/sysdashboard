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
        <header>
            <h1><?php echo $application->title; ?></h1>
            <nav role="primary navigation">
                <ul>
                <?php
                foreach ($application->tabs as $tab) {
                    echo '<li>', $tab->name, '</li>';
                }
                ?>
                </ul>
            </nav>
        </header>
        <?php foreach ($application->tabs as $tab) { ?>
        <article>
            <h1><?php echo $tab->name; ?></h1>
        </article>
        <?php } ?>
    </body>
</html>

