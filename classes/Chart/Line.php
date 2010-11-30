<?php
/**
 * Line chart image
 */
class Chart_Line extends Core_GetterSetter
{
    /**
     * Image width
     * 
     * @var int
     */
    private $_width;
    
    /**
     * Image height
     * 
     * @var int
     */
    private $_height;
    
    
    
    /**
     * Constructor
     * 
     * @param   int     $width      Image width
     * @param   int     $height     Image height
     */
    public function __construct($width, $height)
    {
        $this->_width = $width;
        $this->_height = $height;
    }
    
    /**
     * Save the image
     * 
     * @param   string  $filePath   Image path
     */
    public function save($filePath)
    {
        // Initialize resource
        $resource = Util_Image::createEmptyImage($this->_width, $this->_height);
        
        // Generate the file
        $result = imagepng($resource, $filePath);
        chmod($filePath, 0777);
        imagedestroy($resource);
        if ($result === false) {
            throw new Exception("Unable to create $filePath");
        }
    }
}