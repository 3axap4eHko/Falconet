<?php
/**
 * @date: 22.04.13
 * @time: 16:59
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: Application.php
 */


namespace Falconet;

use Phalcon\Config;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Application as PhalconApplication;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\View;
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
    const VIEW        = 'view';

    protected $initializer = [
        self::LOADER,
        self::MODULE,
        self::ROUTER,
        self::DISPATCHER,
        self::VIEW,
    ];

    /**
     * @var FactoryDefault
     */
    protected $_di;

    public static function factory($configDir)
    {
        $application = new Application();
        $application->init($configDir);

        return $application;
    }

    protected function init($configDir)
    {
        if (Version::getId() - self::VERSION * 1000000 > 10000) {
            throw new \Exception('Require Phalcon version ' . self::VERSION);
        }
        $this->setDI($this->_di = new FactoryDefault());
        $this->_di->set(self::CONFIG, $config = new Config(include rtrim($configDir, '\\/') . '/global.php'));
        $config->merge(new Config(include rtrim($configDir, '\\/') . '/local.php'));

        set_error_handler([$this, 'errorHandler']);
        set_exception_handler([$this, 'exceptionHandler']);
        foreach ($this->initializer as $init) {
            $method = "init$init";
            if (method_exists($this, $method)) {
                $this->_di->set($init, call_user_func_array([$this, $method], [$config->get($init, new Config())]));
            }
        }
    }

    public function run()
    {
        echo $this->handle()->getContent();
    }

    protected function initLoader(Config $config)
    {
        $loader = new Loader();
        if ($config->offsetExists('namespaces')) {
            $loader->registerNamespaces($config->get('namespaces')->toArray());
        }
        if ($config->offsetExists('prefixes')) {
            $loader->registerPrefixes($config->get('prefixes')->toArray());
        }
        $loader->register();

        return $loader;
    }

    protected function initModule(Config $config)
    {
        $namespaces = [];
        $modules = [];
        $moduleDir  = $config->get('dir');
        foreach ($config->get('list') as $module) {
            $dir                 = sprintf('%1$s%2$s%3$s', $moduleDir, DIRECTORY_SEPARATOR, $module);
            $namespaces[$module] = sprintf('%1$s%2$ssrc%2$s%3$s', $dir, DIRECTORY_SEPARATOR, $module);
            $this->_di->get(self::CONFIG)->merge(new Config(include sprintf('%1$s%2$sconfig/module.php',
                                                                            $dir,
                                                                            DIRECTORY_SEPARATOR)));
            $modules[$module] = [
                'className' => sprintf('%s\\Module', $module),
                'path'      => sprintf('%s%sModule.php', $dir, DIRECTORY_SEPARATOR),
            ];
        }
        $this->registerModules($modules);
        $this->_di->get(self::LOADER)->registerNamespaces($namespaces, true);
    }

    protected function initRouter(Config $config)
    {
        $router  = new Router(false);
        $matches = [];
        foreach ($config as $name => $routes) {
            $controller = $routes->get('controller');
            $module     = $routes->get('module');
            foreach ($routes->get('actions') as $action => $pattern) {
                $methods = null;
                if (preg_match('/\((.+)\)(.+)/', $pattern, $matches)) {
                    $methods = explode('|', $matches[1]);
                    $pattern = preg_replace('/\((.+)\)(.+)/', '$2', $pattern);
                }
                $paths = [
                    'module' => $module,
                    'controller' => $controller,
                    'action' => $action
                ];
                $route = $router->add($pattern, $paths, $methods);
                $route->setName($name . '-' . $action);
            }
        }
        $router->setDefaultModule($module);

        return $router;
    }

    public function initView(Config $config)
    {
        $view = new View();

        return $view;
    }

    public function errorHandler()
    {

    }

    public function exceptionHandler(\Exception $e)
    {
        echo nl2br('Fatal Error: ' . $e->getMessage() . PHP_EOL);
        echo nl2br($e->getTraceAsString());
    }

}