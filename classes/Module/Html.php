<?php
/**
 * Module to display a HTML text
 */
class Module_Html extends Core_Module
{
    /**
     * The text
     *
     * @var string
     */
    private $_text;

    /**
     * Module width in pixel
     *
     * @var int
     */
    private $_width;
    
    
    
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

        // Initialize width
        if (isset($config['width'])) {
            $this->_width = $config['width'];
        }

        // Initialize content
        if (isset($config['text'])) {
            $this->_text = (string) $config['text'];
        } else {
            $this->_text = '';
        }
        if (file_exists($this->_dataFilePath)) {
            if (!is_readable($this->_dataFilePath)) {
                throw new Exception("{$this->_dataFilePath} is not readable");
            }
            $data = file_get_contents($this->_dataFilePath);
            if (!empty($data)) {
                $this->_text = $data;
            }
        }
    }

    /**
     * Module data
     *
     * @var mixed
     */
    public function get_data()
    {
        if (file_exists($this->_dataFilePath)) {
            if (!is_readable($this->_dataFilePath)) {
                throw new Exception("{$this->_dataFilePath} is not readable");
            }
            $data = file_get_contents($this->_dataFilePath);
            if (!empty($data)) {
                return $data;
            }
        }
        return '';
    }
    public function set_data($value)
    {
        $result = @file_put_contents($this->_dataFilePath, $value);
        if ($result === false) {
            throw new Exception("{$this->_dataFilePath} is not writable");
        }
    }

    /**
     * Get the HTML display of the module
     * 
     * @return  string  HTML display
     */
    public function getHTML()
    {
        return $this->get_data();
    }
}
