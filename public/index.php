<?php
require dirname(__FILE__).'/../bootstrap.php';
$application = Application::getInstance();

?><!DOCTYPE html>
<html>
    <head>
        <title><?php echo $application->title; ?></title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
    <body>
        <header>
            <h1><?php echo $application->title; ?></h1>
            <nav role="primary navigation">
                <ul>
                <?php
                $tabIndex = 0;
                foreach ($application->tabs as $tab) {
                    echo '<li><a href="#tab', $tabIndex, '">', $tab->name, '</a></li>', "\n";
                    $tabIndex++;
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

