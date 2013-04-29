<?php
/**
 * @date: 22.04.13
 * @time: 17:44
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: index.php
 */

require_once dirname(__DIR__) . '/vendor/Falconet/Application.php';
\Falconet\Application::factory(dirname(__DIR__) . '/config')->run();

function debug(){
    call_user_func_array('var_dump',func_get_args());die;
}