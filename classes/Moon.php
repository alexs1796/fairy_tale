<?php

class Moon extends CelestialObject
{

    public function objectRise()
    {
        $this->objectRise = true;
    }

    public function objectSet()
    {
        $this->setObjectType(CelestialObjectType::NOCTURNAL);
    }
}