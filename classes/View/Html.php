<?php
/**
 * HTML view
 */
class View_Html extends Core_View
{
    /**
     * Constructor
     * 
     * @param   Application     $application    Application instance
     */
    public function __construct(Application $application)
    {
        parent::__construct($application);
    }
    
    /**
     * Display the error and quit
     * 
     * @param   string  $message    The error message
     */
    public function renderError($message)
    {
        header('HTTP/1.0 500 Internal Servor Error');
        header('Content-Type: text/html');
        
        $content = '<!DOCTYPE html>
        <html>
            <head>
                <title>Error</title>
                <meta charset="utf-8" />
                <link rel="stylesheet" type="text/css" href="style.css"/>
            </head>
            <body class="error">
                <h1>An error occurred</h1>
                <p>'.$this->_sanitize($message).'</p>
            </body>
        </html>';
        echo $content;
        exit;
    }
    
    /**
     * Display the application
     */
    public function render()
    {
        try {
            $content = $this->_getHTML();
            
            header('Content-Type: text/html');
            echo $content;
            exit;
        } catch (Exception $error) {
            $this->renderError($error->getMessage());
        }
    }
    
    /**
     * Sanitize a text for a html content
     * 
     * @param   string  $text   The text to sanitize
     */
    private function _sanitize($text)
    {
        return htmlspecialchars($text, ENT_NOQUOTES, 'UTF-8');
    }
    
    /**
     * Get the HTML content
     * 
     * @return  string  The HTML content
     */
    private function _getHTML()
    {
        $tabCount = count($this->_application->tabs);
        
        // Start document
        $content = '<!DOCTYPE html>
        <html>
            <head>
                <title>'.$this->_sanitize($this->_application->title).'</title>
                <meta charset="utf-8" />
                <link rel="stylesheet" type="text/css" href="style.css"/>
                <script type="text/javascript" src="ui.js"></script>
            </head>
            <body>';
        
        // Start header
        $content .= '<header><h1>'.$this->_sanitize($this->_application->title).'</h1>';
        
        // Tabs
        $content .= '<nav id="tabs" role="primary navigation"><ul>';
        for ($index = 0; $index < $tabCount; $index++) {
            $tab = $this->_application->tabs[$index];
            if ($index === 0) {
                $content .= '<li class="selected">';
            } else {
                $content .= '<li>';
            }
            $content .= '<a href="#tab'.$index.'" rel="tab'.$index.'" onClick="changeTab(\'tab'.$index.'\')">'.$tab->name.'</a></li>'."\n";
        }
        $content .= '</ul></nav>';
        
        // End header
        $content .= '</header>';
        
        // Tab contents
        for ($index= 0; $index < $tabCount; $index++) {
            $tab = $this->_application->tabs[$index];
            $content .= '<article id="tab'.$index.'"';
            if ($index === 0) {
                $content .= ' class="selected">';
            } else {
                $content .= '>';
            }
            $content .= '<h1>'.$this->_sanitize($tab->name).'</h1>';
            if (count($tab->sections) === 0) {
                $content .= '<p>Empty</p>';
            } else {
                $content .= $this->_renderChildren($tab->sections);
            }
            $content .= '</article>';
        }
        
        // End document
        $content .= '</body></html>';
        
        return $content;
    }
    
    /**
     * Render children of type Core_Section and/or Core_Module
     * 
     * @param   array   $children   List
     */
    private function _renderChildren($children)
    {
        $content = '';
        foreach ($children as $child) {
            if ($child instanceof Core_Section) {
                $section = $child;
                $style = $section->style;
                $class = 'layout_'.$section->layout;
                if (!empty($style)) {
                    $class .= ' '.$style;
                }
                $content .= '<section class="'.$class.'">';
                $content .= '<h1>'.$this->_sanitize($section->name).'</h1>';
                $content .= $this->_renderChildren($section->children);
                $content .= '</section>';
            } else if ($child instanceof Core_Module) {
                $module = $child;
                $moduleStyle = $module->getStyle();
                $content .= '<div class="module"';
                if (!empty($moduleStyle)) {
                    $content .= ' style="'.$moduleStyle.'">';
                } else {
                    $content .= '>';
                }
                $content .= $module->getHTML();
                $content .= '</div>';
            }
            $content .= ' ';
        }
        return $content;
    }
}