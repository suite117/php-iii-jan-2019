<?php
// Event Class
namespace src\ModSPL\StandardDatastructures\SplPriorityQueue;
class Event
{
    protected $name;
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }
}