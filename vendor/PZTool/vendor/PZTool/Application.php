<?php
/**
 * @date: 12.04.13
 * @time: 15:49
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: Application.php
 */


namespace PZTool;


use Phalcon\CLI\Console;
use Phalcon\DI\FactoryDefault as DI;
use Phalcon\Mvc\Dispatcher\Exception;
use Phalcon\Version;

class Application
{
    const VERSION = 1.1;

    const GIT_FALCONET = '';
    const GIT_PZ_TOOL   = '';

    const SITE_URL = 'http';

    public static function init($arguments)
    {
        set_error_handler('PZTool\Application::errorHandler');
        set_exception_handler('PZTool\Application::exceptionHandler');
        if( Version::getId() - self::VERSION * 1000000 > 10000 ) {
            throw new \Exception('Require Phalcon version ' . self::VERSION);
        }
        $application = new Console();
        $application->setDI($di = new DI());
        $application->registerModules(array(
                                          'PZTool' => array(
                                              'className' => 'PZTool\Module',
                                              'path'      => __DIR__ . '/Module.php'
                                          ),
                                      ));
        $di->set('router', $router = new Router());
        $router->setDefaultModule('PZTool');
        $router->setDefaultTask('help');
        $router->setDefaultAction('help');
        $di->set('dispatcher', $dispatcher = new Dispatcher());
        $dispatcher->setDI($di);
        $dispatcher->setDefaultNamespace('PZTool\Task');
        $application->handle($arguments);
    }

    public static function errorHandler()
    {

    }

    public static function exceptionHandler(Exception $e)
    {
        echo 'Fatal Error: ' . $e->getMessage() . PHP_EOL;
    }

}