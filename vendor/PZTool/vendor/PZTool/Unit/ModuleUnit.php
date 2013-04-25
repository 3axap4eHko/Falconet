<?php
/**
 * @date: 22.04.13
 * @time: 16:19
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: ModuleUnit.php
 */
 

namespace PZTool\Unit;

use Phalcon\Tag\Exception;
use Zend\Code\Generator\ClassGenerator;

class ModuleUnit  extends AbstractUnit
{
    protected $directories = [
        'config',
        'public',
        'view',
        'src',
    ];

    public function create($module)
    {
        $module = ucfirst($module);
        if(empty($module)) {
            throw new Exception('Invalid module name');
        }elseif(file_exists($module)) {
            throw new Exception('Module directory already exists');
        }
        mkdir($module, 0755, true);
        chdir($module);
        $this->createDirectories($this->directories);

        $moduleClass = $this->getClass('Module', 'AbstractModule');
        $moduleFile = getcwd() . '/' . $module;
        $this->saveFile($moduleFile, $moduleClass, $module, ['PZTool\\Mvc\\Module\\AbstractModule']);
    }
}