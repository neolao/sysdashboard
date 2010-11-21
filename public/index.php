<?php
require dirname(__FILE__).'/../bootstrap.php';
$application = Application::getInstance();
$tabCount = count($application->tabs);

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
                for ($index = 0; $index < $tabCount; $index++) {
                    $tab = $application->tabs[$index];
                    if ($index === 0) {
                        echo '<li class="selected">';
                    } else {
                        echo '<li>';
                    }
                    echo '<a href="#tab', $index, '">', $tab->name, '</a></li>', "\n";
                }
                ?>
                </ul>
            </nav>
        </header>
        <?php
        for ($index = 0; $index < $tabCount; $index++) {
            $tab = $application->tabs[$index];
            if ($index === 0) {
                echo '<article class="selected">';
            } else {
                echo '<article>';
            }
            echo '<h1>', $tab->name, '</h1>';
            echo '</article>';
        }
        ?>
    </body>
</html>

