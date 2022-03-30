<!DOCTYPE html>
<html>
<title>
    Fairy Tale
</title>
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">``
    <head>
        <style>


            ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;
                background-color: #333;
            }

            li {
                float: left;
            }

            li a {
                font-weight: bold;
                font-size: 20px;
                display: block;
                color: white;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;

            }

            li a:hover {
                background-color: #111;
            }


            .footer {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                background-color: #333;
                color: white;
                text-align: center;
            }

            .header {
                position: fixed;
                left: 0;
                top: 0;
                width: 100%;
                background-color: #333;
                color: white;
                text-align: center;
            }
            .button {
                background-color: gray;
                border: none;
                color: black;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 20px;
                margin: 4px 2px;
                cursor: pointer;
                font-weight:bold;
            }

            .container {
                height: 100%;
                display: grid;
                width: 15%;
                padding: 20px 25px 20px 20px;
            }



            .button1 {background-color: #4CAF50;} /* Green */
            .button2 {background-color: #fcba03;} /* yellow */
            .button3 {background-color: #26468c;} /* Blue */
            .button4 {background-color: #e7e7e7; } /* White */
            .button5 {background-color: saddlebrown;} /* Black */
        </style>
    </head>
</head>

<body id="body" style="background-color:lightblue; height: 100%">
<div class="header">
    <ul>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="views/logs/logs.php">Logs</a></li>
    </ul>
</div>

<h1 style="text-align:center; width:100%;">Welcome</h1>
<div class="container">
    <div><h2>Choose one of the options below</h2> :</div>
    <form action="views/forms/day_type.php">
         <input class="button" type="submit" id="day" name="dayType" value="day" onclick="dayBackground()">
         <input class="button" type="submit" id="night" name="dayType" value="night" onclick="nightBackground()">
    </form>
    <hr><hr><hr>

    <button class="button button1">
        <a class="button button1" href="views/forms/hero_form.php">Hero</a>
    </button>
    <button class="button button2">
        <a class="button button2" href="views/forms/sun_form.php">Sun</a>
    </button>
    <button class="button button3">
        <a class="button button3" href="views/forms/moon_form.php">Moon</a>
    </button>
    <button class="button button4">
        <a class="button button4" href="views/forms/good_people_form.php">Good People</a>
    </button>
    <button class="button button5">
        <a class="button button5" href="views/forms/bad_people_form.php">Bad People</a>
    </button>
</div>

<div class="footer">
    <h4>Fairy Tale</h4>
</div>
</body>

<script>
</script>
</html>

<?php

require_once ("classes/CelestialObject.php");
require_once ("classes/People.php");
require_once ("classes/GoodPeople.php");
require_once ("classes/Sun.php");
require_once ("classes/Moon.php");
require_once ("classes/BadPeople.php");
require_once ("classes/Hero.php");






