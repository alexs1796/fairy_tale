<?php

class GoodPeople extends People
{

    public function __construct(){

    }

    public function action(){
        return $this->getName() . " Praises the hero";
    }
}