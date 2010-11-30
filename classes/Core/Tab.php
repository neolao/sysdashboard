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
     * @param   Application         $application    Application instance
     * @param   string              $name           Tab name
     * @param   SimpleXMLElement    $config         Configuration XML
     */
    public function __construct(Application $application, $name, $config)
    {
        if (empty($name)) {
            throw new Exception("Tab name required");
        }
        $this->_name = $name;
        
        // Initialize sections
        $this->_sections = array();
        foreach ($config->children() as $sectionConfig) {
            $childType = $sectionConfig->getName();
            if ($childType !== 'section') {
                throw new Exception("The tab \"$name\" should contain sections");
            }
            $sectionName = $sectionConfig['name'];
            $section = new Core_Section($application, $sectionName, $sectionConfig);
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
