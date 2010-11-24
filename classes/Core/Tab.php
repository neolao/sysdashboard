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
     * Sections, array of Core_Section
     *
     * @var array
     * @see Core_Section
     */
    private $_sections;



    /**
     * Constructor
     *
     * @param   string  $name   Tab name
     * @param   object  $config Configuration object
     */
    public function __construct($name, $config)
    {
        $this->_name = $name;
        
        // Initialize sections
        $this->_sections = array();
        foreach ($config as $sectionName => $sectionConfig) {
            $section = new Core_Section($sectionName, $sectionConfig);
            $this->_sections[] = $section;
        }
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



    /**
     * Sections
     *
     * @return  array   Sections
     */
    public function get_sections()
    {
        return $this->_sections;
    }
}
