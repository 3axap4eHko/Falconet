<?php
/**
 * @date: 29.04.13
 * @time: 17:23
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: Module.php
 */


namespace System;

use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{

    /**
     * Register a specific autoloader for the module
     */
    public function registerAutoloaders()
    {

    }

    /**
     * Register specific services for the module
     */
    public function registerServices($di)
    {
        $di->set('dispatcher', function() {
            $dispatcher = new \Phalcon\Mvc\Dispatcher();
            $dispatcher->setDefaultNamespace('System\\Controller');
            return $dispatcher;
        });
    }
}