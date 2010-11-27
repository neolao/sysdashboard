<?php
/**
 * A module
 */
class Core_Module extends Core_GetterSetter
{
    /**
     * Module name
     *
     * @var string
     */
    protected $_name;

    /**
     * File path of the module data
     */
    protected $_dataFilePath;

    /**
     * Directory path of the module public data
     */
    protected $_publicDirectoryPath;



    /**
     * Constructor
     * 
     * @param   Application     $application    Application instance
     * @param   string          $name           Module name
     * @param   array           $config         Module configuration
     */
    public function __construct(Application $application, $name, $config)
    {
        $this->_name = $name;
        $this->_dataFilePath = DATA_PATH.'/'.$this->_name;
        $this->_publicDirectoryPath = PUBLIC_PATH.'/data/'.$this->_name;
    }

    /**
     * Module name
     *
     * @return  string  Module name
     */
    public function get_name()
    {
        return $this->_name;
    }

    /**
     * Module data
     *
     * @var mixed
     */
    public function get_data()
    {
        if (file_exists($this->_dataFilePath)) {
            $data = file_get_contents($this->_dataFilePath);
            return json_decode($data);
        }
        return null;
    }
    public function set_data($value)
    {
        $json = json_encode($value);
        file_put_contents($this->_dataFilePath, $json);
    }

    /**
     * Get the HTML display of the module
     * 
     * @return  string  HTML display
     */
    public function getHTML()
    {
        return '';
    }

    /**
     * Get the module style
     * 
     * @return  string  Module style
     */
    public function getStyle()
    {
        return '';
    }

    /**
     * Create the public directory
     */
    protected function _createPublicDirectory()
    {
        if (!is_dir($this->_publicDirectoryPath)) {
            mkdir($this->_publicDirectoryPath, 0755, true);
        }
    }
}
