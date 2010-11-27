<?php
/**
 * Module to display a pie chart
 */
class Module_PieChart extends Core_Module
{
    /**
     * Pie diameter
     * 
     * @var int
     */
    private $_diameter;
    
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
        
        // Initialize pie diameter
        if (isset($config['diameter'])) {
            $this->_diameter = (int) $config['diameter'];
        } else {
            $this->_diameter = 30;
        }
        
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
        // Value list for the pie
        if (is_array($value)) {
            $percentValues = $value;
        } else if (is_numeric($value)) {
            $percentValues = array($value);
        } else {
            throw new Exception('Invalid data');
        }
        
        // Save the data
        parent::set_data($value);
        
        // Generate pie image
        $this->_createPublicDirectory();
        $imagePath = $this->_publicDirectoryPath.'/pie.png';
        $pieChart = new Chart_Pie($this->_diameter);
        foreach ($percentValues as $value) {
            $pieChart->addPercentValue($value);
        }
        $pieChart->save($imagePath);
    }
    

    /**
     * Get the HTML display of the module
     * 
     * @return  string  HTML display
     */
    public function getHTML()
    {
        $imagePath = $this->_publicDirectoryPath.'/pie.png';
        $imageURL = 'data/'.$this->_name.'/pie.png';
        if (!file_exists($imagePath)) {
            $this->setData(0);
        }
        
        return '<p><img src="'.$imageURL.'" style="vertical-align: middle"/> '.$this->_label.'</p>';
    }
}
