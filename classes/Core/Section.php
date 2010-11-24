<?php
/**
 * A tab section
 */
class Core_Section extends Core_GetterSetter
{
    /**
     * Section name
     *
     * @var string
     */
    private $_name;
    
    /**
     * Module names, array of string
     *
     * @var array
     */
    private $_moduleNames;



    /**
     * Constructor
     *
     * @param   string  $name   Section name
     * @param   object  $config Configuration object
     */
    public function __construct($name, $config)
    {
        $this->_name = $name;
        
        // Initialize sections
        if (isset($config->modules)) {
            $this->_moduleNames = $config->modules;
        } else {
            $this->_moduleNames = array();
        }
        
    }
    
    
    
    /**
     * Section name
     *
     * @return  string  Section name
     */
    public function get_name()
    {
        return $this->_name;
    }



    /**
     * Module names
     *
     * @return  array   Module names
     */
    public function get_moduleNames()
    {
        return $this->_moduleNames;
    }
}