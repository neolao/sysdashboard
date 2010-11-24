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
     * Module width
     */
    private $_width;
    
    
    
    /**
     * Constructor
     * 
     * @param   string  $name   Module name
     * @param   Object  $config Module config
     */
    public function __construct($name, $config)
    {
        parent::__construct($name, $config);

        // Initialize width
        if (isset($config->width)) {
            $this->_width = $config->width;
        }

        // Initialize content
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



    /**
     * Get the module style
     * 
     * @return  string  Module style
     */
    public function getStyle()
    {
        if (!empty($this->_width)) {
            return 'width: '.$this->_width.'px';
        }

        return '';
    }

}
