<?php

require_once ("../../classes/CelestialObject.php");
require_once ("../../classes/Moon.php");
require_once ("../../repositories/MoonRepository.php");
require_once ("../../includes/database.php");
require_once ("../../includes/Constants.php");
require_once ("../../classes/DayType.php");

$moon = new Moon();


$error = array();
try {
    if (isset($_GET['saved'])) {
        $moon->setSaved($_GET['saved']);
    }

    if (isset($_GET['stolen'])) {
        $moon->setStolen($_GET['stolen']);
    }
} catch (Exception $ex){
    echo '<script>
            alert("'.$ex->getMessage().'") 
            window.location.href = "../forms/moon_form.php"
        </script>';
    exit;
}

$moonRepo = new MoonRepository($conn);
$moonRepo->save($moon);
$moonRepo->setMoonRise();
echo '<script>
    location.href = "../../index.php"
</script>';




