<?php
/**
 * @date: 12.04.13
 * @time: 17:05
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: HelpTask.php
 */


namespace PZTool\Task;

use PZTool\Task;
use Phalcon\DI;

class HelpTask extends Task
{
    public function helpAction()
    {
        $this->writeLine('
     _______  _______  _______  _______  _______  __
    / ___  / /___   / /__  __/ / ___  / / ___  / / /
   / /__/ /     / /     / /   / /  / / / /  / / / /
  / _____/    / /      / /   / /  / / / /  / / / /
 / /        / /___    / /   / /__/ / / /__/ / / /_____
/_/       /______/   /_/   /______/ /______/ /_______/');
        $this->writeLine('');
        $this->writeLine('Usage: pz unit:action [parameters]');
        $this->writeLine('');
        $this->writeLine('Unit list:');
        $this->writeLine('   Project');
        $this->writeLine('   Module');
        $this->writeLine('   Config');
        $this->writeLine('   Controller');
        $this->writeLine('   Router');
        $this->writeLine('   Action');
        $this->writeLine('   Model');
        $this->writeLine('   View');
        $this->writeLine('   Form');
        $this->writeLine('   Assets');
        $this->writeLine('');
    }
}