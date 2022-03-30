<?php
require_once ("../../includes/Logg.php");

class MoonRepository
{
    private $db;
    private $logg;

    public function __construct($db){
        $this->db = $db;
        $this->logg = new Logg($db);
    }

    public function save($moonObj){

        $existingMoon = $this->findExistingMoon();
        if(!$existingMoon){
            //add a new moon if there's none
            $this->add($moonObj);
        }
        else {
            /*
             * Update existing moon (if exists)
             */
            $this->update($existingMoon, $moonObj);
        }
    }

    /*
     * Update existing moon properties
     */
    private function update($moonObj, $newOBj){
        $query = "
            UPDATE moon
            SET saved = ".$newOBj->saved.",
            stolen = " . $newOBj->stolen."
            WHERE id = ".$moonObj['id']."
        ";

        mysqli_query($this->db, $query);

        $loggArray = arraY(
            'saved' => $newOBj->saved,
            'stolen' => $newOBj->stolen,

        );

        $this->logg->saveEvent(get_class($this),__METHOD__,$loggArray);
    }

    /*
     * checking if moon exists
     */
    public function findExistingMoon(){
        $query = "SELECT * FROM moon";

        $result = mysqli_query($this->db, $query);
        if ($result->num_rows > 0) {
            // output data of our existent moon
            $row = $result->fetch_assoc();
//            var_dump($row);
            return $row;
        } else {
            return false;
        }
    }

    /*
     * inserting moon
     */
    private function add(moon $moon){


        $query = "
            INSERT INTO moon (stolen, saved)
            VALUES(".$moon->stolen.",".$moon->saved.");
        ";

        mysqli_query($this->db, $query);

        $loggArray = arraY(
            'saved' => $moon->saved,
            'stolen' => $moon->stolen,

        );

        $this->logg->saveEvent(get_class($this),__METHOD__,$loggArray);

    }

    public function setMoonRise(){
        $celestial_obj_prop = new DayType($this->db);
        $celestialData = $celestial_obj_prop->findCelestialObject();
        $moonData = $this->findExistingMoon();
        if ($celestialData['day_type'] == Constants::NIGHT){
            if($moonData['stolen'] == true) {
                $celestial_obj_prop->setCelestialobjectRise('false');
            } else {
                $celestial_obj_prop->setCelestialobjectRise('true');
            }
        }

    }
}