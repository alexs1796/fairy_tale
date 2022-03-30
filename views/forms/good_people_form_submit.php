<?php


include ("../../classes/People.php");
include ("../../classes/GoodPeople.php");
include ("../../repositories/GoodPeopleRepository.php");
include("../../includes/database.php");

$goodPeople = new GoodPeople();
//setting hero attributes
if ( isset($_GET['name']) ){
    $goodPeople->setName($_GET['name']);
}

if ( isset($_GET['age']) ){
    $goodPeople->setAge($_GET['age']);
}
if ( isset($_GET['height']) ){
    $goodPeople->setHeight($_GET['height']);
}

$goodPeopleRepo = new GoodPeopleRepository($conn);
$goodPeopleRepo->save($goodPeople);

echo '<script>
    location.href = "../../index.php"
</script>';


