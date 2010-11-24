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
