<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
define('DIR_BIN', __DIR__);

$loader = new \Phalcon\Loader();
$loader->registerNamespaces(array(
                                'Zend'   => __DIR__ . '/../vendor/Zend',
                                'PZTool' => __DIR__ . '/../vendor/PZTool',
                            ))->register();
\PZTool\Application::init($argv);

function debug(){
    call_user_func_array('var_dump',func_get_args());die;
}