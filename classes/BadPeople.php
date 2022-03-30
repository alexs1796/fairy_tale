<?php

class BadPeople extends People
{

    public function __construct(){
    }

    public function action(){
        return $this->getName() . " says : ";
    }

}