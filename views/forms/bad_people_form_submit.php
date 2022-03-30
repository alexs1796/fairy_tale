<?php


include ("../../classes/People.php");
include ("../../classes/BadPeople.php");
include ("../../repositories/BadPeopleRepository.php");
include("../../includes/database.php");
$badPeople = new BadPeople();
//setting hero attributes
if ( isset($_GET['name']) ){
    $badPeople->setName($_GET['name']);
}

if ( isset($_GET['age']) ){
    $badPeople->setAge($_GET['age']);
}
if ( isset($_GET['height']) ){
    $badPeople->setHeight($_GET['height']);
}

$badPeopleRepo = new BadPeopleRepository($conn);
$badPeopleRepo->save($badPeople);

echo '<script>
    location.href = "../../index.php"
</script>';


