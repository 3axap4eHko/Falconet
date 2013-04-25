<?php
/**
 * @date: 12.04.13
 * @time: 15:34
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: AbstractUnit.php
 */


namespace PZTool\Unit;

use Phalcon\Config;

class AbstractUnit
{
    protected $projectDirectory;

    public function __construct($projectDirectory = null)
    {
        if (!empty($projectDirectory)) {
            $this->setProjectDirectory($projectDirectory);
        }
    }

    public function setProjectDirectory($projectDirectory)
    {
        if (empty($projectDirectory)) {
            throw new \Exception('Invalid project directory');
        }
        $this->projectDirectory = $projectDirectory;


        return $this;
    }

    public function getProjectDirectory()
    {
        return $this->projectDirectory;
    }

    public static function factory()
    {
        $reflection = new \ReflectionClass(get_called_class());

        return $reflection->newInstanceArgs(func_get_args());
    }

    protected function createDirectories($directories)
    {
        foreach ($directories as $directory) {
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
        }

        return $this;
    }

    public static function getCamelCase($name)
    {
        $name = str_replace(array('.', '-', '_'), ' ', $name);
        $name = ucwords($name);
        $name = str_replace(' ', '', $name);

        return $name;
    }
}