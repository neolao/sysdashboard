<?php
/**
 * Module to display a text
 */
class Module_Text extends Core_Module
{
    /**
     * The text
     */
    private $_text;
    
    
    
    /**
     * Constructor
     * 
     * @param   string  $name   Module name
     * @param   Object  $config Module config
     */
    public function __construct($name, $config)
    {
        parent::__construct($name, $config);
        
        if (isset($config->text)) {
            $this->_text = $config->text;
        } else {
            $this->_text = '';
        }
    }
    
    
    
    /**
     * Get the HTML display of the module
     * 
     * @return  string  HTML display
     */
    public function getHTML()
    {
        return $this->_text;
    }
}