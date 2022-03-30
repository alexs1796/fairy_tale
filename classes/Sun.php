<?php



class Sun extends CelestialObject
{

    public function __construct(){
    }

    public function objectRise()
    {
        $this->objectRise = true;
    }

    public function objectSet()
    {
        $this->setObjectType(CelestialObjectType::DIURNAL);
    }

}