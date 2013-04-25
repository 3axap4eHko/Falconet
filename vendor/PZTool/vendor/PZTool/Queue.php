<?php
/**
 * @date: 25.04.13
 * @time: 15:11
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: Queue.php
 */


namespace PZTool;

class Queue extends \SplDoublyLinkedList
{
    public function enqueue()
    {
        $this->push(func_get_args());
        return $this;
    }

    public function dequeue()
    {
        return $this->shift();
    }
}