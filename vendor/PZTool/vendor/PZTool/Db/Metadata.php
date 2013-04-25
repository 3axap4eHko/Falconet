<?php
/**
 * @date: 15.04.13
 * @time: 11:14
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: Metadata.php
 */


namespace PZTool\Db;


use Phalcon\DI;

class Metadata
{
    protected $metadata;

    public function __construct($table)
    {
        DI::getDefault();
    }
}