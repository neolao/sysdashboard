<?php
/**
 * Mobile view
 */
class View_Mobile extends Core_View
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
            </head>
            <body>';
        
        // Header
        $content .= '<header><h1>'.$this->_sanitize($this->_application->title).'</h1></header>';
        
        // End document
        $content .= '</body></html>';
        
        return $content;
    }
}