<?php

namespace Model;

class Visitor
{
    // private $name;
    private $ip;

    public function __construct($ip)
    {
        // $this->name = $name;
        $this->ip = $ip;
    }

    // public function setName($name)
    // {
    //     $this->name = $name;
    // }

    public function setIP($ip)
    {
        $this->ip = $ip;
    }


    // public function getName()
    // {
    //     return $this->name;
    // }

    public function getIP()
    {
        return $this->ip;
    }
}
