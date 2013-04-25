<?php
/**
 * @date: 12.04.13
 * @time: 16:11
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: Dispatcher.php
 */


namespace PZTool;

class Dispatcher extends \Phalcon\CLI\Dispatcher
{
    protected $queue;

    public function setQueue(Queue $queue)
    {
        $this->queue = $queue;
        return $this;
    }

    public function getQueue()
    {
        if( !$this->queue instanceof Queue) {
            $this->queue = new Queue();
        }
        return $this->queue;
    }
}