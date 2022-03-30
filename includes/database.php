<?php

global $conn;
$dbServerName = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'epic_story';


$conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

if(!$conn){
        die("no db connection");
}