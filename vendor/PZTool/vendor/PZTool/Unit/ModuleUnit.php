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
use Zend\Code\Generator\FileGenerator;

class ModuleUnit  extends AbstractUnit
{
    const DIR_CONFIG = ProjectUnit::DIR_CONFIG;
    const DIR_PUBLIC = ProjectUnit::DIR_PUBLIC;
    const DIR_VIEW   = 'view';
    const DIR_SRC    = 'src';

    const FILE_MODULE = 'Module.php';

    protected $directories = [
        self::DIR_CONFIG,
        self::DIR_PUBLIC,
        self::DIR_VIEW,
        self::DIR_SRC,
    ];

    public function create($module)
    {
        chdir(ProjectUnit::DIR_MODULES);
        $module = ucfirst($module);
        if(empty($module)) {
            throw new Exception('Invalid module name');
        }elseif(file_exists($module)) {
            throw new Exception('Module directory already exists');
        }
        mkdir($module, 0755, true);
        chdir($module);
        $this->createDirectories($this->directories);

        $moduleClass = new ClassGenerator('Module', null, null, 'AbstractModule');
        $moduleClass->addUse('PZTool\\Mvc\\Module\\AbstractModule');

        $file   = new FileGenerator();
        $file->setFilename(self::FILE_MODULE);
        $file->setNamespace($module);
        $file->setBody($moduleClass->generate());
        die($file->generate());
//        $file->write();

    }
}