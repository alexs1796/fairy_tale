<?php
require_once ("../../includes/Logg.php");

class HeroRepository
{
    private $db;
    private $logg;

    public function __construct($db){
        $this->db = $db;
        $this->logg = new Logg($db);
    }

    public function save(){
        $hero = $this->findExistingHero();
        if(!$hero){
            //add a new hero if there's none
            $this->add();
        }
        else {
            /*
             * Update existing Hero (if exists)
             */
            $this->update($hero['id']);
        }
    }

    /*
     * Update existing Hero properties
     */
    private function update($heroId){
        $query = "
            UPDATE hero
            SET name = '".Hero::getInstance()->getName()."',
            weapon = '".Hero::getInstance()->getWeapon()."',
            gender = '".Hero::getInstance()->getGender()."',
            action = '".Hero::getInstance()->getAction()."'
            WHERE id = $heroId
        ";

        mysqli_query($this->db, $query);

        $loggArray = arraY(
            'name' => Hero::getInstance()->getName(),
            'weapon' => Hero::getInstance()->getWeapon(),
            'gender' => Hero::getInstance()->getGender(),
            'action' => HERO::getInstance()->getAction()
        );

        $this->logg->saveEvent(get_class($this),__METHOD__,$loggArray);


    }

    /*
     * checking if hero exists
     */
    public function findExistingHero(){
        $query = "SELECT * FROM hero";

        $result = mysqli_query($this->db, $query);
        if ($result->num_rows > 0) {
            // output data of our existent Hero
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return false;
        }
    }

    /*
     * inserting hero
     */
    private function add(){
        $query = "
            INSERT INTO hero (name, weapon, gender, action)
            VALUES('".Hero::getInstance()->getName()."','".Hero::getInstance()->getWeapon()."','".Hero::getInstance()->getGender()."','".Hero::getInstance()->getAction()."');
        ";
        $loggArray = arraY(
            'name' => Hero::getInstance()->getName(),
            'weapon' => Hero::getInstance()->getWeapon(),
            'gender' => Hero::getInstance()->getGender(),
            'action' => HERO::getInstance()->getAction()
        );

        mysqli_query($this->db, $query);
        $this->logg->saveEvent(get_class($this),__METHOD__,$loggArray);


    }

    public function heroAction($action){
        $dayType = new DayType($this->db);
        if( $action == Constants::RUN ) {

            $dayType->setCelestialobjectRise(false);
        }

        if( $action == Constants::FIGHT ) {
            $dayType->setCelestialobjectRise('true');
        }
    }
}