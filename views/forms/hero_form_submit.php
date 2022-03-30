<?php

include ("../../classes/CelestialObject.php");
include ("../../includes/Constants.php");
include ("../../classes/Sun.php");
include ("../../classes/Hero.php");
include("../../repositories/HeroRepository.php");
include ("../../includes/database.php");
include ("../../classes/DayType.php");


$hero = Hero::getInstance();
if ( isset($_GET['name']) ){
    $hero->setName($_GET['name']);
}

if ( isset($_GET['gender']) ){
    $hero->setGender($_GET['gender']);
}
if ( isset($_GET['weapon']) ){
    $hero->setWeapon($_GET['weapon']);
}

if ( isset($_GET['action'])) {
    $hero->setAction($_GET['action']);
}

$heroRepo = new HeroRepository($conn);
$heroRepo->save();
$heroRepo->heroAction(HERO::getInstance()->getAction());

echo '<script>
    location.href = "../../index.php"
</script>';


