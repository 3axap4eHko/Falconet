<?php
/**
 * @date: 25.04.13
 * @time: 14:49
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: ConfigGenerator.php
 */


namespace PZTool\Code\Generator;

use Zend\Code\Generator\PropertyValueGenerator;

class ConfigGenerator extends PropertyValueGenerator
{
    /**
     * @return string
     */
    public function generate()
    {
        return 'return ' . parent::generate();
    }
}