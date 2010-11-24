<?php
/**
 * Module to display a pie chart
 */
class Module_PieChart extends Core_Module
{
    /**
     * Constructor
     * 
     * @param   string  $name   Module name
     * @param   Object  $config Module config
     */
    public function __construct($name, $config)
    {
        parent::__construct($name, $config);
    }

    /**
     * Set the module data
     *
     * @param  mixed   $data    New module data
     */
    public function setData($data)
    {
        parent::setData($data);

        // TODO Generate pie image
        $this->_createPublicDirectory();
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
}
