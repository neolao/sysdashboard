<?php
/**
 * A getter setter base class
 */ 
abstract class Core_GetterSetter
{
    /**
     * Getter magic method
     *
     * @param   string  $name   Property name
     * @return  mixed           Property value
     */
    public function __get($name) 
    {
        if (method_exists($this, "get_$name")) {
            return $this->{"get_$name"}();
        } else if (method_exists($this, "set_$name")) {
            throw new Exception("Writeonly property $name");
        } else {
            throw new Exception("Undefined property $name");
        }
    }

    /**
     * Setter magic method
     *
     * @param   string  $name   Property name
     * @param   mixed   $value  New property value
     */
    public function __set($name, $value)
    {
        if (method_exists($this, "set_$name")) {
            $this->{"set_$name"}($value);
        } else if (method_exists($this, "get_$name")) {
            throw new Exception("Readonly property $name");
        } else {
            throw new Exception("Undefined property $name");
        }
    }
}

