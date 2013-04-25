<?php
/**
 * @date: 25.04.13
 * @time: 14:25
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: Metadata.php
 */


namespace PZTool;


use Phalcon\Config;

class Metadata extends Config
{
    protected $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
        parent::__construct(json_decode(include $filename));
    }

    public function offsetGet($index)
    {
        echo 'of';
    }

    public function get($index, $default = null)
    {
        echo 'set';
/*        $this->merge(new Config(json_decode(include $this->filename)));
        return $this->get()*/
    }

}