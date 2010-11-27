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
     * List of Core_Section and/or Core_Module
     *
     * @var array
     */
    private $_children;

    /**
     * Section layout
     *
     * @var string
     */
    private $_layout;

    /**
     * Section style
     *
     * @var string
     */
    private $_style;



    /**
     * Constructor
     * 
     * @param   Application         $application    Application instance
     * @param   string              $name           Section name
     * @param   array               $config         Configuration
     */
    public function __construct(Application $application, $name, $config)
    {
        $this->_name = $name;

        // Initialize layout
        if (isset($config['layout'])) {
            $this->_layout = (string) $config['layout'];
        } else {
            $this->_layout = 'horizontal';
        }

        // Initialize style
        if (isset($config['style'])) {
            $this->_style = (string) $config['style'];
        } else {
            $this->_style = '';
        }

        // Initialize children
        $this->_children = array();
        foreach ($config->children() as $child) {
            $childType = $child->getName();
            $childName = '';
            if (isset($child['name'])) {
                $childName = (string) $child['name'];
            }
            if ($childType === 'module') {
                $module = $application->modules[$childName];
                if ($module instanceof Core_Module) {
                    $this->_children[] = $module;
                }
            } else {
                $section = new Core_Section($application, $childName, $child);
                $this->_children[] = $section;
            }
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
     * Section style
     *
     * @return  string  Section style
     */
    public function get_style()
    {
        return $this->_style;
    }

    /**
     * Children
     *
     * @return  array   List of Core_Section and/or Core_Module
     */
    public function get_children()
    {
        return $this->_children;
    }
}
