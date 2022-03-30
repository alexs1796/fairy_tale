<?php

require_once("../../classes/Sun.php");
require_once("../../classes/Moon.php");

class DayType
{
    public $data;
    public $day_type;
    public $sql;
    public $logg;
    public $sun;
    public $moon;
    public $sunProp;
    public $moonProp;

    public function __construct($db, $day_type = null )
    {
        $this->day_type = $day_type;
        $this->sql = $db;
        $this->logg = new Logg($db);
        $this->sun = new Sun();
        $this->moon = new Moon();

        if ($day_type == 'day') {
            $this->sunProperties();
        } elseif ($day_type == 'night') {
            $this->nightProperties();
        }

    }


    public function sunProperties(){

        $this->sunProp = new SunRepository($this->sql);
        $this->sun->objectSet();
        $this->sun->objectRise();


        $this->data = $this->sun;

        return $this;
    }


    public function nightProperties(){

        $this->moonProp = new MoonRepository($this->sql);
        $this->moon->objectSet();
        $this->moon->objectRise();


        $this->data = $this->moon;

        return $this;
    }

    public function save($day_type){
        $celestialObject = null;
        //dayType prop from day_type table
        $existingDayType = $this->findCelestialObject();
        //existing sun/moon - prop depending on the day;
        if($this->day_type == Constants::DAY) {
            $celestialObject = $this->sunProp->findExistingSun();
        }

        if($this->day_type == Constants::NIGHT) {
            $celestialObject = $this->moonProp->findExistingMoon();
        }

        if(!$existingDayType) {
            $this->add($day_type, $celestialObject);
        } else {
            $this->update($existingDayType, $day_type, $celestialObject);
        }

    }

    public function findCelestialObject(){
        $query = "SELECT * FROM day_type";

        $result = mysqli_query($this->sql, $query);
        if ($result->num_rows > 0) {
            // output data of our existent Hero
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return false;
        }

    }

    public function add($obj, $celestialObject){

        $query = "
            INSERT INTO day_type(day_type, object_type, object_rise)
            VALUES ('".$this->day_type."','".$obj->objectType."','".$celestialObject->objectRise."')
        ";

        mysqli_query($this->sql, $query);

        $arrayLog = array(
            'day_type' => $this->day_type,
            'object_type' => $obj->objectType,
            'object_rise' => $obj->objectRise
        );

        $this->logg->saveEvent(get_class($this),__METHOD__, $arrayLog);
    }

    public function update($oldProp, $newProp, $celestialObjectProperties){

        if(empty($celestialObjectProperties))
            $objectRise = 1;

        if($celestialObjectProperties['stolen'] == true) {
            $objectRise = 0;
        }

        if($celestialObjectProperties['saved'] == true) {
            $objectRise = 1;
        }

        $query = "
            UPDATE day_type
            SET day_type ='". $this->day_type ."',
                object_type = '". $newProp->objectType . "',
                object_rise = ". $objectRise."
            WHERE id = '".$oldProp['id']."'
        ";

        mysqli_query($this->sql, $query);

        $arrayLog = array(
            'day_type' => $this->day_type,
            'object_type' => $newProp->objectType,
            'object_rise' => $objectRise
        );

        $this->logg->saveEvent(get_class($this),__METHOD__, $arrayLog);
    }

    public function setCelestialobjectRise($rise){
        $celestialObj = $this->findCelestialObject();

        $query = "
            UPDATE day_type
            SET object_rise = $rise
            where id = " . $celestialObj['id'] . "
        ";

//        echo $query;die;
        mysqli_query($this->sql, $query);
        $arrayLog = array(
            'object_rise' =>  $rise
        );

        $this->logg->saveEvent(get_class($this), __METHOD__,$arrayLog);
    }

}