<?php
/**
 * @date: 12.04.13
 * @time: 17:24
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: Task.php
 */


namespace PZTool;

use PZTool\stdLib\ArrayObject;

class Task extends \Phalcon\CLI\Task
{
    /**
     * @var Unit\AbstractUnit
     */
    protected $unit;
    /**
     * @var ArrayObject
     */
    protected $params;

    final public function initialize()
    {
        $unitName      = preg_replace('/(\w+)Task/', '$1', current(array_reverse(explode('\\', get_called_class()))));
        $unitClassName = sprintf(__NAMESPACE__ . '\\Unit\\%sUnit', $unitName);
        $this->params  = new ArrayObject($this->dispatcher->getParams());
        $this->params->ksort();
        $this->unit = new $unitClassName();
        $this->init();
    }

    protected function init()
    {
    }

    protected function readLine()
    {
        $h     = fopen('php://stdin', 'r');
        $input = fgets($h);
        fclose($h);

        return $input;
    }

    protected function writeLine($text)
    {
        $h = fopen('php://stdout', 'w');
        fputs($h, $text . PHP_EOL);
        fclose($h);
    }

    protected function getParam($name = null, $default = null)
    {
        if ($name !== null) {
            return $this->params->get($name, $default);
        } else {
            return $this->params;
        }
    }

    protected function getParamAlt($name, $altName)
    {
        return $this->params->get($name, $this->params->get($altName));
    }

    public function helpAction()
    {
        $this->writeLine('Actions:');
        $ref = new \ReflectionClass(get_called_class());
        $matches = array();
        foreach ($ref->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            $name = $method->getName();
            if (preg_match('/^(\w+)Action$/', $name, $matches)) {
                $this->writeLine(" - " . $matches[1]);
            }
        }
    }

    public function afterExecuteRoute($dispatcher)
    {
        if($dispatcher->getQueue()->count()) {
            call_user_func_array(array($this, 'forward'), $dispatcher->getQueue()->dequeue());
        }
    }

    public function queueForward($controller, $action, array $params = array())
    {
        $this->dispatcher->getQueue()->enqueue($controller, $action, $params);
        return $this;
    }

    public function forward($controller, $action, array $params = array())
    {
        $this->dispatcher->setParams($params);
        $this->dispatcher->forward(array(
                                       'controller' => $controller,
                                       'action'     => $action
                                   ));
    }

}