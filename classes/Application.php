<?php
/**
 * The main application.
 */
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
     *
     * @return  string  The application name
     */
    public function get_title()
    {
        return $this->_title;
    }

    /**
     * Module list
     *
     * @return  array  Module list
     */
    public function get_modules()
    {
        return $this->_modules;
    }

    /**
     * Tab list
     *
     * @return  array  Tab list
     */
    public function get_tabs()
    {
        return $this->_tabs;
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
        // TODO Check json content
        $content = file_get_contents($filePath);
        $json = json_decode($content);

        foreach ($json as $moduleName => $moduleConfig) {
            // If the type is not defined, then it continues
            if (!isset($moduleConfig->type)) {
                continue;
            }
            
            // If the type is not a class, then it continues
            $moduleType = $moduleConfig->type;
            if (!class_exists($moduleType)) {
                continue;
            }
            
            // Initialize the module
            $module = new $moduleType($moduleName, $moduleConfig);
            if ($module instanceof Core_Module) {
                $this->_modules[$module->name] = $module;
            }
        }
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
        // TODO Check json content
        $content = file_get_contents($filePath);
        $json = json_decode($content);

        foreach ($json as $tabName => $tabConfig) {
            $tab = new Core_Tab($tabName, $tabConfig);
            $this->_tabs[] = $tab;
        }
    }
}
