<?php
/**
 * The main application.
 */
class Application extends Core_GetterSetter
{
    /**
     * Constant for the HTML view
     * 
     * @var string
     */
    const HTML_VIEW = 'HTML_VIEW';
    
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
     * View type
     * 
     * @var string
     */
    private $_viewType;
    
    /**
     * View instance
     * 
     * @var Core_View
     */
    private $_view;



    /**
     * Constructor
     */
    private function __construct()
    {
        $this->_title = 'SYS DASHBOARD';
        $this->_modules = array();
        $this->_tabs = array();
        $this->viewType = self::HTML_VIEW;
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
     * @var string
     */
    public function get_title()
    {
        return $this->_title;
    }

    /**
     * Module list
     *
     * @var array
     */
    public function get_modules()
    {
        return $this->_modules;
    }

    /**
     * Tab list
     *
     * @var array
     */
    public function get_tabs()
    {
        return $this->_tabs;
    }
    
    /**
     * View type
     * 
     * @var string
     */
    public function get_viewType()
    {
        return $this->_viewType;
    }
    public function set_viewType($value)
    {
        switch ($value) {
            case self::HTML_VIEW:
                $view = new View_Html();
                break;
            default:
                return;
        }
        $this->_viewType = $value;
        $this->_view = $view;
        set_error_handler(array($view, 'errorHandler'));
    }
    
    /**
     * View instance
     * 
     * @var Core_View
     */    
    public function get_view()
    {
        return $this->_view;
    }
    
    /**
     * Initialize the application
     *
     * @param   string      $filePath       Configuration file path
     * @throws  Exception                   Invalid configuration file
     */
    public function initialize($filePath)
    {
        try {
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
        } catch (Exception $error) {
            $this->view->renderError($error->getMessage());
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
        try {
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
        } catch (Exception $error) {
            $this->view->renderError($error->getMessage());
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
        try {
            if (!file_exists($filePath)) {
                throw new Exception("File does not exist $filePath");
            }

            // Get the configuration content and unserialize it
            // TODO Check xml content
            $xml = simplexml_load_file($filePath);

            foreach ($xml->children() as $tabXML) {
                $tabName = $tabXML['name'];
                $tab = new Core_Tab($tabName, $tabXML);
                $this->_tabs[] = $tab;
            }
        } catch (Exception $error) {
            $this->view->renderError($error->getMessage());
        }
    }
}
