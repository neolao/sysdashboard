<?php
/**
 * Pie chart image
 */
class Chart_Pie extends Core_GetterSetter
{
    /**
     * Image size
     * 
     * @var int
     */
    private $_size;
    
    /**
     * Percent values
     * 
     * @var array
     */
    private $_percentValues;
    
    /**
     * Color order of the parts
     * 
     * @var array
     */
    private $_colors;
    
    /**
     * Color of the undefined value
     * 
     * @var int
     */
    private $_undefinedValueColor;
    
    
    
    /**
     * Constructor
     * 
     * @param   int     $size   Image size
     */
    public function __construct($size)
    {
        $this->_size = $size;
        $this->_percentValues = array();
        $this->_undefinedValueColor = 0xDDDDDDFF;
        $this->_colors = array(
            0x0000FFFF,
            0x00FF00FF,
            0xFF0000FF,
            0xFFFF00FF
        );
    }
    
    /**
     * Add a percent value
     * 
     * @param   float   $percent    Percent value
     */
    public function addPercentValue($percent)
    {
        $this->_percentValues[] = (float) $percent;
    }
    
    /**
     * Save the image
     * 
     * @param   string  $filePath   Image path
     */
    public function save($filePath)
    {
        // Initialize resource
        $resource = Util_Image::createEmptyImage($this->_size, $this->_size);
        
        // The center of the pie
        $center = $this->_size / 2;
        
        // Draw the background
        Util_Image::drawFilledCircle($resource, $center, $center, $this->_size, $this->_undefinedValueColor);
        
        // Draw each arc
        $count = count($this->_percentValues);
        $colorCount = count($this->_colors);
        $startDegree = -90;
        for ($index = 0; $index < $count; $index++) {
            $percentValue = $this->_percentValues[$index];
            
            // The value cannot be equal to zero
            if ($percentValue == 0) {
                continue;
            }
            
            // Find the end degree
            $endDegree = $startDegree + 360 / 100 * $percentValue;
            
            // Find the color fill
            $color = $this->_colors[$index % $colorCount];
            
            // Draw
            Util_Image::drawFilledArc($resource, $center, $center, $this->_size, $startDegree, $endDegree, $color);
            
            // Save the new start degree
            $startDegree = $endDegree;
        }
        
        // Generate the file
        $result = imagepng($resource, $filePath);
        imagedestroy($resource);
        if ($result === false) {
            throw new Exception("Unable to create $filePath");
        }
    }
}