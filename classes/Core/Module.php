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
    private $_name;



    /**
     * Constructor
     * 
     * @param   string  $name   Module name
     * @param   Object  $config Module config
     */
    public function __construct($name, $config)
    {
        $this->_name = $name;
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
        $dataFile = DATA_PATH.'/'.$this->_name;
        if (file_exists($dataFile)) {
            return file_get_contents($dataFile);
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
        $dataFile = DATA_PATH.'/'.$this->_name;
        file_put_contents($dataFile, $data);
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
}
