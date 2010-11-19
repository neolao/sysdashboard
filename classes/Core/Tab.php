<?php
/**
 * A tab
 */
class Core_Tab extends Core_GetterSetter
{
    /**
     * Tab name
     *
     * @var string
     */
    private $_name;



    /**
     * Constructor
     *
     * @param   string  $name   Tab name
     * @param   object  $config Configuration object
     */
    public function __construct($name, $config)
    {
        $this->_name = $name;
    }



    /**
     * Tab name
     *
     * @return  string  Tab name
     */
    public function get_name()
    {
        return $this->_name;
    }
}
