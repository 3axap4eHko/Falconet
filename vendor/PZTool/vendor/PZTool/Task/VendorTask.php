<?php
/**
 * @date: 23.04.13
 * @time: 17:37
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: VendorTask.php
 */


namespace PZTool\Task;

use PZTool\Task;
use PZTool\Unit\VendorUnit;

class VendorTask extends Task
{
    /**
     * @var VendorUnit
     */
    protected $unit;

    public function createAction()
    {
        $type = $this->getParamAlt('type',0);
        $source = $this->getParamAlt('source',1);
        $this->unit->setProjectDirectory(getcwd());
        $this->unit->create($source,  $type);
    }
}