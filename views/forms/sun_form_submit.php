<?php

require ("../../classes/CelestialObject.php");
include ("../../classes/Sun.php");
include ("../../repositories/SunRepository.php");
include ("../../includes/database.php");
include ("../../includes/Constants.php");
include ("../../classes/DayType.php");


$sun = new Sun();


$error = array();
try {
    if (isset($_GET['saved'])) {
        $sun->setSaved($_GET['saved']);
    }

    if (isset($_GET['stolen'])) {
        $sun->setStolen($_GET['stolen']);
    }
} catch (Exception $ex){
    echo '<script>
            alert("'.$ex->getMessage().'") 
            window.location.href = "../forms/sun_form.php"
        </script>';
    exit;
}
$sunRepo = new SunRepository($conn);
$sunRepo->save($sun);
$sunRepo->setSunRise();
echo '<script>
    location.href = "../../index.php"
</script>';




