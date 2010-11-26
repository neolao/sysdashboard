<?php
/**
 * A view
 */
class Core_View
{
    /**
     * Application instance
     * 
     * @var Application
     */
    protected $_application;
    
    /**
     * Constructor
     * 
     * @param   Application     $application    Application instance
     */
    public function __construct(Application $application)
    {
        $this->_application = $application;
    }
    
    /**
     * Display the error and quit
     * 
     * @param   string  $message    The error message
     */
    public function renderError($message)
    {
    }
    
    /**
     * Display the application
     */
    public function render()
    {
    }
    
    /**
     * Error handler
     * 
     * @param   int     $level      The level of the error raised
     * @param   string  $message    The error message
     * @param   string  $file       The file name that the error was raised in
     * @param   int     $line       The line number the error was raised at
     */
    public function errorHandler($level, $message, $file, $line)
    {
        $this->renderError($message." at $file ($line)");
    }
}