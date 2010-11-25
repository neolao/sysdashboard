<?php
/**
 * Image utils
 */
class Util_Image
{
    /**
     * Create an empty image resource
     * 
     * @param   int         $width      Image width
     * @param   int         $height     Image height
     * @return  resource                Image resource
     */
    public static function createEmptyImage($width, $height)
    {
        $resource = @imagecreatetruecolor($width, $height);
        if ($resource === false) {
            throw new Exception('Cannot create new image '.$width.'x'.$height);
        }
        imagesavealpha($resource, true);
        imageantialias($resource, false);
        $transparent = imagecolorallocatealpha($resource, 0, 0, 0, 127);
        imagefill($resource, 0, 0, $transparent);
        
        return $resource;
    }
    
    /**
     * Draw a filled circle
     * 
     * @param   resource    $resource   Image resource
     * @param   int         $x          X coordinate of the center
     * @param   int         $y          Y coordinate of the center
     * @param   int         $size       Diameter
     * @param   int         $color      RGBA color
     */
    public static function drawFilledCircle($resource, $x, $y, $size, $color)
    {
        Util_Image::drawFilledArc($resource, $x, $y, $size, 0, 360, $color);
    }
    
    /**
     * Draw a filled arc
     * 
     * @param   resource    $resource       Image resource
     * @param   int         $x              X coordinate of the center
     * @param   int         $y              Y coordinate of the center
     * @param   int         $start          The arc start angle, in degrees.
     * @param   int         $end            The arc end angle, in degrees.
     * @param   int         $size           Diameter
     * @param   int         $color          RGBA color
     */
    public static function drawFilledArc($resource, $x, $y, $size, $start, $end, $color)
    {
        // Create a temporary image, in order to antialiase
        $tempSize = $size * 2 + 1;
        $tempCenter = $size;
        $temp = Util_Image::createEmptyImage($tempSize, $tempSize);
        
        // Create the color value
        list($red, $green, $blue, $alpha) = Util_Image::color2rgba($color);
        $colorValue = imagecolorallocatealpha($temp, $red, $green, $blue, 127-$alpha/2);
        
        // Draw the circle
        $center = floor($size / 2);
        imagefilledarc($temp, $tempCenter, $tempCenter, $tempSize, $tempSize, $start, $end, $colorValue, IMG_ARC_PIE);
        imagecopyresampled($resource, $temp, $x - $center, $y - $center, 0, 0, $size, $size, $tempSize, $tempSize);
    }
    
    /**
     * Parses a color value to an array
     * 
     * @param   int     $color      The color value
     * @return  array               RGB components
     */
    public static function color2rgb($color)
    {
        $red = 0xFF & ($color >> 16);
        $green = 0xFF & ($color >> 8);
        $blue = 0xFF & ($color >> 0);
        return array($red, $green, $blue);
    }

    /**
     * Parses a color (with alpha) value to an array
     * 
     * @param   int     $color      The color value with alpha
     * @return  array               RGBA components
     */
    public static function color2rgba($color)
    {
        $red = 0xFF & ($color >> 24);
        $green = 0xFF & ($color >> 16);
        $blue = 0xFF & ($color >> 8);
        $alpha = 0xFF & ($color >> 0);
        return array($red, $green, $blue, $alpha);
    }
}