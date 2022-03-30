<?php
require_once ("../../includes/Logg.php");

class GoodPeopleRepository
{
    private $db;
    private $logg;

    public function __construct($db){
        $this->db = $db;
        $this->logg = new Logg($db);
    }

    public function save($goodPeopleObj){

        $existingGoodPeople = $this->findGoodPeople();
        if(!$existingGoodPeople){
            //add a new goodPeople if there's none
            $this->add($goodPeopleObj);
        }
        else {
            /*
             * Update existing goodPeople (if exists)
             */
            $this->update($existingGoodPeople, $goodPeopleObj);
        }
    }

    /*
     * Update existing goodPeople properties
     */
    private function update($goodPeopleObj, $newOBj){
        $query = "
            UPDATE moon
            SET height = ".$newOBj->height.",
            age = " . $newOBj->age.",
            name = " . $newOBj->name.",
            WHERE id = ".$goodPeopleObj['id']."
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
     * checking if goodPeople exists
     */
    public function findGoodPeople(){
        $query = "SELECT * FROM good_people";

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
     * inserting goodPeople
     */
    private function add(GoodPeople $goodPeople){


        $query = "
            INSERT INTO good_people (name, height, age)
            VALUES('".$goodPeople->name."','".$goodPeople->height."','".$goodPeople->age."');
        ";

        mysqli_query($this->db, $query);

        $loggArray = arraY(
            'height' => $goodPeople->height,
            'age' => $goodPeople->age,
            'name' => $goodPeople->name,
        );

        $this->logg->saveEvent(get_class($this),__METHOD__,$loggArray);

    }
}