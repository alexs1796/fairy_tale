<?php
require_once ("../../includes/Logg.php");

class SunRepository
{
    private $db;
    private $logg;

    public function __construct($db){
        $this->db = $db;
        $this->logg = new Logg($db);
    }

    public function save($sunObj){

        $existingSun = $this->findExistingSun();
        if(!$existingSun){
            //add a new sun if there's none
            $this->add($sunObj);
        }
        else {
            /*
             * Update existing sun (if exists)
             */
            $this->update($existingSun, $sunObj);
        }
    }

    /*
     * Update existing sun properties
     */
    private function update($sunObj, $newOBj){
        $query = "
            UPDATE sun
            SET saved = ".$newOBj->saved.",
            stolen = " . $newOBj->stolen."
            WHERE id = ".$sunObj['id']."
        ";

        mysqli_query($this->db, $query);


        $loggArray = arraY(
            'saved' => $newOBj->saved,
            'stolen' => $newOBj->stolen,
        );

        $this->logg->saveEvent(get_class($this),__METHOD__,$loggArray);
    }

    /*
     * checking if sun exists
     */
    public function findExistingSun(){
        $query = "SELECT * FROM sun";

        $result = mysqli_query($this->db, $query);
        if ($result->num_rows > 0) {
            // output data of our existent sun
            $row = $result->fetch_assoc();
//            var_dump($row);
            return $row;
        } else {
            return false;
        }
    }

    /*
     * inserting sun
     */
    private function add(Sun $sun){

        $query = "
            INSERT INTO sun (stolen, saved)
            VALUES(".$sun->getStolen().",".$sun->getSaved().");
        ";

        mysqli_query($this->db, $query);

        $loggArray = arraY(
            'saved' => $sun->saved,
            'stolen' => $sun->stolen,

        );

        $this->logg->saveEvent(get_class($this),__METHOD__,$loggArray);
    }

    //checking if sun can rise based on different actions.
    public function setSunRise(){
        $celestial_obj_prop = new DayType($this->db);
        $celestialData = $celestial_obj_prop->findCelestialObject();
        $sunData = $this->findExistingSun();
        if ($celestialData['day_type'] == Constants::DAY){
            if($sunData['stolen'] == true) {
                $celestial_obj_prop->setCelestialobjectRise('false');
            } else {
                $celestial_obj_prop->setCelestialobjectRise('true');
            }
        }

    }
}