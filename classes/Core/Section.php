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
     * Section layout
     *
     * @var string
     */
    private $_layout;



    /**
     * Constructor
     *
     * @param   string  $name   Section name
     * @param   object  $config Configuration object
     */
    public function __construct($name, $config)
    {
        $this->_name = $name;

        // Initialize layout
        if (isset($config->layout)) {
            $this->_layout = $config->layout;
        } else {
            $this->_layout = 'floatLeft';
        }

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
     * Section layout
     *
     * @return  string  Section layout
     */
    public function get_layout()
    {
        return $this->_layout;
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
