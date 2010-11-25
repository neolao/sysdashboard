<?php
require dirname(__FILE__).'/../bootstrap.php';
$application = Application::getInstance();
$application->addTabs(CONFIG_PATH.'/tabs.xml');

$tabCount = count($application->tabs);

function renderChildren($children)
{
    foreach ($children as $child) {
        if ($child instanceof Core_Section) {
            $section = $child;
            $style = $section->style;
            $class = 'layout_'.$section->layout;
            if (!empty($style)) {
                $class .= ' '.$style;
            }
            echo '<section class="', $class, '">';
            echo '<h1>', $section->name, '</h1>';
            renderChildren($section->children);
            echo '</section>';
        } else if ($child instanceof Core_Module) {
            $module = $child;
            $moduleStyle = $module->getStyle();
            echo '<div class="module"';
            if (!empty($moduleStyle)) {
                echo ' style="', $moduleStyle, '">';
            } else {
                echo '>';
            }
            echo $module->getHTML();
            echo '</div>';
        }
        echo ' ';
    }
}
?><!DOCTYPE html>
<html>
    <head>
        <title><?php echo $application->title; ?></title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <script type="text/javascript" src="ui.js"></script>
    </head>
    <body>
        <header>
            <h1><?php echo $application->title; ?></h1>
            <nav id="tabs" role="primary navigation">
                <ul>
                <?php
                for ($index = 0; $index < $tabCount; $index++) {
                    $tab = $application->tabs[$index];
                    if ($index === 0) {
                        echo '<li class="selected">';
                    } else {
                        echo '<li>';
                    }
                    echo '<a href="#tab', $index, '" rel="tab', $index, '" onClick="changeTab(\'tab', $index, '\')">', $tab->name, '</a></li>', "\n";
                }
                ?>
                </ul>
            </nav>
        </header>
        <?php
        for ($index = 0; $index < $tabCount; $index++) {
            $tab = $application->tabs[$index];
            echo '<article id="tab', $index, '"';
            if ($index === 0) {
                echo ' class="selected">';
            } else {
                echo '>';
            }
            echo '<h1>', $tab->name, '</h1>';
            renderChildren($tab->sections);
            echo '</article>';
        }
        ?>
    </body>
</html>

