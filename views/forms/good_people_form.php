<?php


require_once ("../../classes/Template.php");
require_once ("../../includes/database.php");
require_once ("../../repositories/GoodPeopleRepository.php");
$args = array();

$template = new Template('good_people_form.html');
$goodPeopleRepo = new GoodPeopleRepository($conn);
$data = $goodPeopleRepo->findGoodPeople();

if($data) {
    $args = array(
        'name' => $data['name'],
        'age' => $data['age'],
        'height' => $data['height']
    );
} else {
    $args = array (
        'name' => '',
        'age' => '',
        'height' => ''
    );
}

$template->set($args);
$template->renderHTML();

