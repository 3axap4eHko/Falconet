<?php
/**
 * @date: 22.04.13
 * @time: 17:30
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: Loader.php
 */


namespace Falconet;


class Loader
{
    protected $namespaces = [];

    public function __construct()
    {
        spl_autoload_register($this);
    }

    protected function load($className)
    {
        $namespace = current(array_reverse(explode('\\', $className)));
        if(isset($this->namespaces[$namespace])) {
            $path = $this->namespaces[$namespace];
            $classPath = $path . str_replace([$namespace, '\\'], ['', DIRECTORY_SEPARATOR], $className) . '.php';
            require_once $classPath;
        }
    }

    public function __invoke($className)
    {
        $this->load($className);
    }

    public function registerNamespace($namespace, $path)
    {
        $this->namespaces[$namespace] = rtrim($path,'\\/');
    }
}