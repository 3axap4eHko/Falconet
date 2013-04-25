<?php
/**
 * @date: 22.04.13
 * @time: 16:59
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: Application.php
 */


namespace Falconet;

use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Micro as PhalconApplication;
use Phalcon\Version;
use Phalcon\Loader;

class Application extends PhalconApplication
{
    const VERSION = 1.1;

    const APPLICATION = 'application';
    const CONFIG      = 'config';
    const CONTROLLER  = 'controller';
    const DI          = 'di';
    const DISPATCHER  = 'dispatcher';
    const ENVIRONMENT = 'environment';
    const LOADER      = 'loader';
    const MODULE      = 'module';
    const ROUTER      = 'router';

    protected $initializer = array(
        self::LOADER,
    );

    public static function init($globalConfig)
    {
        if (Version::getId() - self::VERSION * 1000000 > 10000) {
            throw new \Exception('Require Phalcon version ' . self::VERSION);
        }
        $application = new Application();
        $application->setDI($di = new FactoryDefault());

        set_error_handler('Falconet\Application::errorHandler');
        set_exception_handler('Falconet\Application::exceptionHandler');


    }

    public static function errorHandler()
    {

    }

    public static function exceptionHandler(\Exception $e)
    {
        echo 'Fatal Error: ' . $e->getMessage() . PHP_EOL;
    }

}