<?php
/**
 * @date: 12.04.13
 * @time: 17:52
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: ConfigTask.php
 */


namespace PZTool\Task;

use PZTool\Task;
use PZTool\Unit\ConfigUnit;


class ConfigTask extends Task
{
    /**
     * @var ConfigUnit
     */
    protected $unit;

    public function createAction()
    {
        $filename = $this->getParamAlt('config', 0);
        $this->unit->create($filename);
    }
}