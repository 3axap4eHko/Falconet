<?php
/**
 * @date: 12.04.13
 * @time: 17:51
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: ProjectTask.php
 */


namespace PZTool\Task;

use PZTool\Task;
use PZTool\Unit\ProjectUnit;

/**
 * Class ProjectTask
 *
 * @package PZTool\Task
 */
class ProjectTask extends Task
{
    /**
     * @var ProjectUnit
     */
    protected $unit;

    public function createAction()
    {
        $projectDir = $this->getParamAlt('project', 0);
        $this->unit->setProjectDirectory($projectDir);
        $this->unit->create();
        $this->queueForward('config', 'create', array('config' => getcwd() . '/config/config.php'));
        if ($this->getParam('falconet')) {
            $this->queueForward('vendor', 'create', array('type' => 'git', 'source' => 'https://github.com/3axap4eHko/Falconet.git'));
        }
    }

}