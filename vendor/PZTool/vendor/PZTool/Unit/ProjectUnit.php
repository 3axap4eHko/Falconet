<?php
/**
 * @date: 15.04.13
 * @time: 11:40
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: ProjectUnit.php
 */


namespace PZTool\Unit;

class ProjectUnit extends AbstractUnit
{
    const DIR_MODULES = 'module';
    const DIR_PUBLIC  = 'public';
    const DIR_ASSETS  = 'public/assets';
    const DIR_VENDOR  = 'vendor';
    const DIR_TEST    = 'test';
    const DIR_CONFIG  = 'config';

    protected $directories = [
        'data/tmp/volt',
        'data/tmp/view',
        'data/tmp/data',
        self::DIR_MODULES,
        self::DIR_ASSETS,
        self::DIR_VENDOR,
        self::DIR_CONFIG,
    ];

    public function create()
    {
        if (file_exists($this->projectDirectory)) {
            throw new \Exception('Project directory already exists');
        }
        mkdir($this->projectDirectory, 0755, true);
        chdir($this->projectDirectory);
        $this->createDirectories($this->directories);
    }
}