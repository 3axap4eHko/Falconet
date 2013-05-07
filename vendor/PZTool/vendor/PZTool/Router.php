<?php
/**
 * @date: 12.04.13
 * @time: 15:54
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: Router.php
 */


namespace PZTool;

class Router extends \Phalcon\CLI\Router
{
    public function getModuleName()
    {
        return __NAMESPACE__;
    }

    public function handle($arguments = null)
    {
        array_shift($arguments);
        $this->_task = array_shift($arguments);
        $matches     = [];
        if (preg_match('/(\w+)([-.=:](\w+))?/', $this->_task, $matches)) {
            $this->_task   = $matches[1];
            $this->_action = array_key_exists(3, $matches) ? $matches[3] : $this->_defaultAction;
        }
        $this->_task   = $this->_task ? : $this->_defaultTask;
        $this->_action = $this->_action ? : $this->_defaultAction;
        $params        = $arguments ? : $this->_defaultParams;
        $matches       = [];
        foreach ($params as $value) {
            if (preg_match('/\-\-(\w+)(=(.+))?$/', $value, $matches)) {
                $this->_params[$matches[1]] = array_key_exists(3, $matches) ? $matches[3] : true;
            } else {
                $this->_params[]=$value;
            }
        }
    }
}