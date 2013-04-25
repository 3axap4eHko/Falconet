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
    public function create($filename, array $data = array())
    {
        if (empty($filename) || !is_dir(dirname($filename))) {
            throw new \Exception('Invalid config filename');
        }
        $file = new FileGenerator();
        $file->setFilename($filename);
        $file->setBody(new ConfigGenerator($data));
        $file->write();
    }
}