<?php
/**
 * @date: 15.04.13
 * @time: 12:51
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: ArrayObject.php
 */


namespace PZTool\stdLib;

class ArrayObject extends \ArrayObject
{
    public function has($name)
    {
        return $this->offsetExists($name);
    }

    public function get($name, $default = null)
    {
        return $this->has($name) ? $this->offsetGet($name) : $default;
    }

    public function set($name, $value)
    {
        $this->offsetSet($name, $value);
        return $this;
    }

}