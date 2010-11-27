<?php
/**
 * API view
 */
class View_Api extends Core_View
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
        header('Content-Type: text/plain');
        
        echo $message;
        exit;
    }
    
    /**
     * Display the application
     */
    public function render()
    {
        try {
            header('Content-Type: text/plain');
            echo 'API view';
            exit;
        } catch (Exception $error) {
            $this->renderError($error->getMessage());
        }
    }
}