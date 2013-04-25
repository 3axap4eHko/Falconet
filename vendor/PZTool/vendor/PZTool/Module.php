<?php
/**
 * @date: 12.04.13
 * @time: 16:20
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: Module.php
 */


namespace PZTool;

use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    public function registerAutoloaders(){}

    public function registerServices($dependencyInjector){}
}