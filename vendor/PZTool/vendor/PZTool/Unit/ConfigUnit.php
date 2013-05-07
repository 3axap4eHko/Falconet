<?php
/**
 * @date: 15.04.13
 * @time: 13:28
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: ConfigUnit.php
 */


namespace PZTool\Unit;

use PZTool\Code\Generator\ConfigGenerator;
use Zend\Code\Generator\FileGenerator;

class ConfigUnit extends AbstractUnit
{
    public function create($filename, array $data = [])
    {
        if (empty($filename) || !is_dir(dirname($filename))) {
            throw new \Exception('Invalid config filename');
        }
        $file = new FileGenerator();
        $file->setFilename($filename);
        $file->setBody(new ConfigGenerator($data));
        $file->write();
    }

    private function enum($config, $keyPath, $value = null)
    {
        $keyPath     = explode('.', $keyPath);
        $configValue = & $config;
        foreach ($keyPath as $key) {
            $configValue = & $configValue[$key];
        }
        if ($value === null) {
            return $configValue;
        } else {
            $configValue = $value;

            return $config;
        }
    }

    public function set($filename, $keyPath, $value)
    {
        if (empty($filename) || !is_dir(dirname($filename))) {
            throw new \Exception('Invalid config filename');
        }
        $config = (new ConfigGenerator($this->enum(include($filename), $keyPath, $value)))->initEnvironmentConstants();
        $file   = new FileGenerator();
        $file->setFilename($filename);
        $file->setBody($config);
        $file->write();
    }

}