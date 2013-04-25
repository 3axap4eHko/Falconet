<?php
/**
 * @date: 22.04.13
 * @time: 16:56
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: Bootstrap.php
 */


namespace Falconet;

use Falconet\DI;
use Falconet\Loader;
use Phalcon\Config;
use Phalcon\DI\FactoryDefault;

require_once __DIR__ . '/Loader.php';

class Bootstrap
{
    protected $_di;

    protected $initializer = [
        DI::ENVIRONMENT,
        DI::LOADER,
        DI::MODULE
    ];

    public function __construct($config)
    {
        $config = new Config($config);
        $this->_di = new FactoryDefault();
        $this->_di->set(DI::CONFIG, $config);
        foreach($this->initializer as $module) {
            $method = 'init' . ucfirst($module);
            if( method_exists($this, $method)) {
                call_user_func_array([$this,$method], [$config->get($module)]);
            }
        }
    }

    public static function factory()
    {
        $ref = new \ReflectionClass(get_called_class());

        return $ref->newInstanceArgs(func_get_args());
    }

    public function initEnvironment()
    {

    }

    public function initLoader()
    {
        $loader = new Loader();
        $loader->registerNamespace('Falconet', __DIR__);
        return $loader;
    }

    public function initModule()
    {

    }

}