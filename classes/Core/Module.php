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
     * @param   string  $name   Module name
     * @param   Object  $config Module config
     */
    public function __construct($name, $config)
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
     * Get the module data
     *
     * @return  mixed   Module data
     */
    public function getData()
    {
        if (file_exists($this->_dataFilePath)) {
            $data = file_get_contents($this->_dataFilePath);
            return json_decode($data);
        }
        return null;
    }

    /**
     * Set the module data
     *
     * @param  mixed   $data    New module data
     */
    public function setData($data)
    {
        $data = json_encode($data);
        file_put_contents($this->_dataFilePath, $data);
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
