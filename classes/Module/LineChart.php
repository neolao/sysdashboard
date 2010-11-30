<?php
/**
 * Module to display a line chart
 */
class Module_LineChart extends Core_Module
{
    /**
     * Module label
     * 
     * @var string
     */
    private $_label;
    
    
    
    /**
     * Constructor
     * 
     * @param   Application     $application    Application instance
     * @param   string          $name           Module name
     * @param   Object          $config         Module config
     */
    public function __construct(Application $application, $name, $config)
    {
        parent::__construct($application, $name, $config);
        
        // Initialize label
        if (isset($config['label'])) {
            $this->_label = (string) $config['label'];
        } else {
            $this->_label = '';
        }
    }

    /**
     * Module data
     *
     * @var mixed
     */
    public function set_data($value)
    {
        // Save the data
        parent::set_data($value);
        
        // Generate pie image
        $this->_createPublicDirectory();
        $imagePath = $this->_publicDirectoryPath.'/line.png';
        $lineChart = new Chart_Line(200, 100);
        $lineChart->save($imagePath);
    }
    

    /**
     * Get the HTML display of the module
     * 
     * @return  string  HTML display
     */
    public function getHTML()
    {
        $imagePath = $this->_publicDirectoryPath.'/line.png';
        $imageURL = 'data/'.$this->_name.'/line.png';
        if (!file_exists($imagePath)) {
            $this->data = '';
        }
        
        $html = '<p><img title="'.$this->_label.'" alt="'.$this->_label.'" src="'.$imageURL.'"/></p>';
        return $html;
    }
}
