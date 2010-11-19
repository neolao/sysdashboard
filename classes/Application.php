<?php
class Application extends Core_GetterSetter
{
    /**
     * The singleton instance
     *
     * @var Application
     */
    private static $_instance;

    /**
     * Application title
     *
     * @var string
     */
    private $_title;

    /**
     * Module list
     *
     * @var array
     */
    private $_modules;

    /**
     * Tab list
     *
     * @var array
     */
    private $_tabs;



    /**
     * Constructor
     */
    private function __constructor()
    {
        $this->_title = 'SYS DASHBOARD';
        $this->_modules = array();
        $this->_tabs = array();
    }

    /**
     * Get the singleton instance
     *
     * @return  Application
     */
    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            $class = __CLASS__;
            self::$_instance = new $class();
        }
        return self::$_instance;
    }

    /**
     * The application name
     */
    public function get_title()
    {
        return $this->_title;
    }

    /**
     * Initialize the application
     *
     * @param   string      $filePath       Configuration file path
     * @throws  Exception                   Invalid configuration file
     */
    public function initialize($filePath)
    {
        if (!file_exists($filePath)) {
            throw new Exception("File does not exist $filePath");
        }

        // Get the configuration content and unserialize it
        $content = file_get_contents($filePath);
        $json = json_decode($content);

        // Set the title
        if (isset($json->title)) {
            $this->_title = $json->title;
        }
    }

    /**
     * Add modules
     *
     * @param   string      $filePath       Configuration file path
     * @throws  Exception                   Invalid configuration file
     */
    public function addModules($filePath)
    {
        if (!file_exists($filePath)) {
            throw new Exception("File does not exist $filePath");
        }

        // Get the configuration content and unserialize it
        $content = file_get_contents($filePath);
        $json = json_decode($content);

    }

    /**
     * Add tabs
     *
     * @param   string      $filePath       Configuration file path
     * @throws  Exception                   Invalid configuration file
     */
    public function addTabs($filePath)
    {
        if (!file_exists($filePath)) {
            throw new Exception("File does not exist $filePath");
        }

        // Get the configuration content and unserialize it
        $content = file_get_contents($filePath);
        $json = json_decode($content);


    }
}
