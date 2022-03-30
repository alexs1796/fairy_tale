<?php

require ("../../classes/CelestialObjectType.php");
require ("../../classes/CelestialObject.php");
require ("../../includes/database.php");
require ("../../classes/Sun.php");
require ("../../classes/Moon.php");
require ("../../classes/DayType.php");
require ("../../repositories/SunRepository.php");
require ("../../repositories/MoonRepository.php");
include ("../../includes/Constants.php");

$type = $_GET['dayType'];

$dayType = new DayType($conn, $type);
$dayType->save($dayType->data);

echo '<script>
    location.href = "../../index.php"
</script>';
