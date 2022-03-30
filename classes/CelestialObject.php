<?php

abstract class CelestialObject
{
    public $objectType; //string (diurnal/nocturnal)
    public $stolen; // boolean
    public $saved; // boolean
    public $dayType; //day/night
    public $objectRise;



    abstract public function objectRise();
    abstract public function objectSet();


    /**
     * @return mixed
     */
    public function getObjectType()
    {
        return $this->objectType;
    }

    /**
     * @param mixed $objectType
     */
    public function setObjectType($objectType)
    {
        $this->objectType = $objectType;
    }

    /**
     * @return mixed
     */
    public function getStolen()
    {
        return $this->stolen;
    }

    /**
     * @param mixed $stolen
     * @throws Exception
     */
    public function setStolen($stolen)
    {
        //first we check the saved property
        if( ($stolen == 'true') && ($this->saved == 'true') ) {
            throw new Exception(Constants::SUN_AND_MOON_EXCEPTION);
        }
        $this->stolen = $stolen;
    }

    /**
     * @return mixed
     */
    public function getSaved()
    {
        return $this->saved;
    }

    /**
     * @param mixed $saved
     * @throws Exception
     */
    public function setSaved($saved)
    {
        //first we check the stolen property
        if( ($saved == 'true') && ($this->stolen == 'true') ){
            throw new Exception(Constants::SUN_AND_MOON_EXCEPTION);
        }

        $this->saved = $saved;

    }

    /**
     * @return mixed
     */
    public function getDayType()
    {
        return $this->dayType;
    }

    /**
     * @param mixed $dayType
     */
    public function setDayType($dayType)
    {
        $this->dayType = $dayType;
    }

    /**
     * @return mixed
     */


    /**
     * @return mixed
     */
    public function getObjectRise()
    {
        return $this->objectRise;
    }

    /**
     * @param mixed $objectRise
     */
    public function setObjectRise($objectRise)
    {
        $this->objectRise = $objectRise;
    }


}