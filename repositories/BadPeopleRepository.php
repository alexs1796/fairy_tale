<?php

require_once ("../../includes/Logg.php");
class BadPeopleRepository
{
    private $db;
    private $logg;

    public function __construct($db){
        $this->db = $db;
        $this->logg = new Logg($db);
    }

    public function save($badPeopleObj){

        $existingBadPeople = $this->findbadPeople();
        if(!$existingBadPeople){
            //add a new badPeople if there's none
            $this->add($badPeopleObj);
        }
        else {
            /*
             * Update existing badPeople (if exists)
             */
            $this->update($existingBadPeople, $badPeopleObj);
        }
    }

    /*
     * Update existing badPeople properties
     */
    private function update($badPeopleObj, $newOBj){
        $query = "
            UPDATE moon
            SET height = ".$newOBj->height.",
            age = " . $newOBj->age.",
            name = " . $newOBj->name.",
            WHERE id = ".$badPeopleObj['id']."
        ";

        mysqli_query($this->db, $query);

        $loggArray = arraY(
            'height' => $newOBj->height,
            'age' => $newOBj->age,
            'name' => $newOBj->name,
        );

        $this->logg->saveEvent(get_class($this),__METHOD__,$loggArray);
    }

    /*
     * checking if badPeople exists
     */
    public function findBadPeople(){
        $query = "SELECT * FROM bad_people";

        $result = mysqli_query($this->db, $query);
        if ($result->num_rows > 0) {
            // output data of our existent moon
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return false;
        }
    }

    /*
     * inserting badPeople
     */
    private function add(BadPeople $badPeople){


        $query = "
            INSERT INTO bad_people (name, height, age)
            VALUES('".$badPeople->name."','".$badPeople->height."','".$badPeople->age."');
        ";
//        echo $query; die;
        mysqli_query($this->db, $query);

        $loggArray = arraY(
            'height' => $badPeople->height,
            'age' => $badPeople->age,
            'name' => $badPeople->name,
        );

        $this->logg->saveEvent(get_class($this),__METHOD__,$loggArray);

    }
}