<?php
/**
 * Module to display a text
 */
class Module_Text extends Core_Module
{
    /**
     * The text
     *
     * @var string
     */
    private $_text;

    /**
     * Font size in pixel
     *
     * @var int
     */
    private $_fontSize;

    /**
     * Font color (css format)
     *
     * Example: #ff000
     *
     * @var string
     */
    private $_fontColor;

    /**
     * Shadow radius in pixel
     *
     * @var int
     */
    private $_shadowRadius;

    /**
     * Shadow color (css format)
     *
     * Example: #ff000
     *
     * @var string
     */
    private $_shadowColor;

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

        // Initialize font size
        if (isset($config['fontSize'])) {
            $this->_fontSize = (int) $config['fontSize'];
        }

        // Initialize font color
        if (isset($config['fontColor'])) {
            $this->_fontColor = $config['fontColor'];
        }

        // Initialize shadow radius
        if (isset($config['shadowRadius'])) {
            $this->_shadowRadius = $config['shadowRadius'];
        }

        // Initialize shadow color
        if (isset($config['shadowColor'])) {
            $this->_shadowColor = $config['shadowColor'];
        }

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
        return $this->_text;
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
        return $this->_text;
    }

    /**
     * Get the module style
     * 
     * @return  string  Module style
     */
    public function getStyle()
    {
        $style = 'white-space: pre;';

        if (!empty($this->_fontSize)) {
            $style .= 'font-size: '.$this->_fontSize.'px;';
        }

        if (!empty($this->_fontColor)) {
            $style .= 'color: '.$this->_fontColor.';';
        }

        if (!empty($this->_shadowRadius)) {
            $shadowColor = '#00000';
            if (!empty($this->_shadowColor)) {
                $shadowColor = $this->_shadowColor;
            }
            $style .= 'text-shadow: 0px 0px '.$this->_shadowRadius.'px '.$this->_shadowColor.';';
            $style .= 'filter: dropshadow(color='.$this->_shadowColor.', offx=0, offy=0);';
        }

        if (!empty($this->_width)) {
            $style .= 'width: '.$this->_width.'px;';
        }

        return $style;
    }

}
