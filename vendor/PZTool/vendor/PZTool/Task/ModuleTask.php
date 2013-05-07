<?php
/**
 * @date: 12.04.13
 * @time: 17:52
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: ModuleTask.php
 */
 

namespace PZTool\Task;

use PZTool\Task;
use PZTool\Unit\ModuleUnit;

class ModuleTask extends Task
{
    /**
     * @var ModuleUnit
     */
    protected $unit;

    public function createAction()
    {
        $moduleName = $this->getParamAlt('module', 0);
        $this->unit->setProjectDirectory(getcwd());
        $this->unit->create($moduleName);
        $this->queueForward('config', 'create', array('config' => getcwd() . '/config/config.php'));
    }
}